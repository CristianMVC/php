<?php


    namespace GCBA\StoreBundle\Helper;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;  
    use GCBA\StoreBundle\Entity\SysLog;
    use Symfony\Component\DependencyInjection\ContainerAware;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
    use Symfony\Component\Yaml\Parser;
    use Doctrine\ORM\Mapping\ClassMetadata;

    use Doctrine\ORM\QueryBuilder;

    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\Config\Definition\Exception\Exception;
    use Symfony\Component\Serializer\Encoder\JsonEncoder;
    use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
    use Symfony\Component\Serializer\Serializer;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    class AudioCaptcha  {



        var $audio_path;
        /**
        * The path which contains securimage.php.
        *
        * @var string    The path to the securimage installation.
        */
        var $basepath;
        /**
        * Path to the file to use for storing codes for users.<br />
        * THIS FILE MUST ABSOLUTELY NOT BE ACCESSIBLE FROM A WEB BROWSER!!<br />
        * Put this file in a directory below the web root or one that is restricted (i.e. an apache .htaccess file with deny from all)<br />
        * If you cannot meet those requirements your forms may not be completely protected.<br />
        * You could obscure the database file name but this is also not recommended.
        * 
        * @var string
        */
        var $sqlite_database;
        public function __construct() {

            $this->audio_path   = $this->basepath . '/audio/';
            $this->audio_format = 'mp3';
            $this->session_name = '';
            $this->expiry_time  = 900;

            $this->sqlite_database = 'database/securimage.sqlite';
            $this->use_sqlite_db   = false;

            $this->sqlite_handle = false;
        }
        function play()
        {

            $this->audio_format = (isset($_GET['format']) && in_array(strtolower($_GET['format']), array('mp3', 'wav')) ? strtolower($_GET['format']) : 'mp3');
            // $this->setAudioPath('/path/to/securimage/audio/');

            $this->outputAudioFile();  

        }

        function getAudibleCode($format = 'wav')
        {
            $letters = array();
            $code    = $this->getCode();

            if ($code == '') {
                $this->createCode();
                $code = $this->getCode();
            }

            for($i = 0; $i < strlen($code); ++$i) {
                $letters[] = $code{$i};
            }

            if ($format == 'mp3') {
                return $this->generateMP3($letters);
            } else {
                return $this->generateWAV($letters);
            }
        }

        /**
        * Set the path to the audio directory.<br />
        *
        * @since 1.0.4
        * @return bool true if the directory exists and is readble, false if not
        */
        function setAudioPath($audio_directory)
        {
            if (is_dir($audio_directory) && is_readable($audio_directory)) {
                $this->audio_path = $audio_directory;
                return true;
            } else {
                return false;
            }
        }
        /**
        * Get the captcha code
        *
        * @since 1.0.1
        * @return string
        */
        function getCode()
        {
            if (isset($_SESSION['securimage_code_value']) && !empty($_SESSION['securimage_code_value'])) {
                return strtolower($_SESSION['securimage_code_value']);
            } else {
                if ($this->sqlite_handle == false) $this->openDatabase();

                return $this->getCodeFromDatabase(); // attempt to get from database, returns empty string if sqlite is not available or disabled
            }
        }

        /**
        * Check if the user entered code was correct
        *
        * @access private
        * @return boolean
        */
        function checkCode()
        {
            return $this->correct_code;
        }

        /**
        * Generate a wav file by concatenating individual files
        *
        * @since 1.0.1
        * @access private
        * @param array $letters  Array of letters to build a file from
        * @return string  WAV file data
        */
        function generateWAV($letters)
        {
            $data_len    = 0;
            $files       = array();
            $out_data    = '';

            foreach ($letters as $letter) {
                $filename = $this->audio_path . strtoupper($letter) . '.wav';

                $fp = fopen($filename, 'rb');

                $file = array();

                $data = fread($fp, filesize($filename)); // read file in

                $header = substr($data, 0, 36);
                $body   = substr($data, 44);


                $data = unpack('NChunkID/VChunkSize/NFormat/NSubChunk1ID/VSubChunk1Size/vAudioFormat/vNumChannels/VSampleRate/VByteRate/vBlockAlign/vBitsPerSample', $header);

                $file['sub_chunk1_id']   = $data['SubChunk1ID'];
                $file['bits_per_sample'] = $data['BitsPerSample'];
                $file['channels']        = $data['NumChannels'];
                $file['format']          = $data['AudioFormat'];
                $file['sample_rate']     = $data['SampleRate'];
                $file['size']            = $data['ChunkSize'] + 8;
                $file['data']            = $body;

                if ( ($p = strpos($file['data'], 'LIST')) !== false) {
                    // If the LIST data is not at the end of the file, this will probably break your sound file
                    $info         = substr($file['data'], $p + 4, 8);
                    $data         = unpack('Vlength/Vjunk', $info);
                    $file['data'] = substr($file['data'], 0, $p);
                    $file['size'] = $file['size'] - (strlen($file['data']) - $p);
                }

                $files[] = $file;
                $data    = null;
                $header  = null;
                $body    = null;

                $data_len += strlen($file['data']);

                fclose($fp);
            }

            $out_data = '';
            for($i = 0; $i < sizeof($files); ++$i) {
                if ($i == 0) { // output header
                    $out_data .= pack('C4VC8', ord('R'), ord('I'), ord('F'), ord('F'), $data_len + 36, ord('W'), ord('A'), ord('V'), ord('E'), ord('f'), ord('m'), ord('t'), ord(' '));

                    $out_data .= pack('VvvVVvv',
                        16,
                        $files[$i]['format'],
                        $files[$i]['channels'],
                        $files[$i]['sample_rate'],
                        $files[$i]['sample_rate'] * (($files[$i]['bits_per_sample'] * $files[$i]['channels']) / 8),
                        ($files[$i]['bits_per_sample'] * $files[$i]['channels']) / 8,
                        $files[$i]['bits_per_sample'] );

                    $out_data .= pack('C4', ord('d'), ord('a'), ord('t'), ord('a'));

                    $out_data .= pack('V', $data_len);
                }

                $out_data .= $files[$i]['data'];
            }

            $this->scrambleAudioData($out_data, 'wav');
            return $out_data;
        }

        /**
        * Randomly modify the audio data to scramble sound and prevent binary recognition.<br />
        * Take care not to "break" the audio file by leaving the header data intact.
        *
        * @since 2.0
        * @access private
        * @param $data Sound data in mp3 of wav format
        */
        function scrambleAudioData(&$data, $format)
        {
            if ($format == 'wav') {
                $start = strpos($data, 'data') + 4; // look for "data" indicator
                if ($start === false) $start = 44;  // if not found assume 44 byte header
            } else { // mp3
                $start = 4; // 4 byte (32 bit) frame header
            }

            $start  += rand(1, 64); // randomize starting offset
            $datalen = strlen($data) - $start - 256; // leave last 256 bytes unchanged

            for ($i = $start; $i < $datalen; $i += 64) {
                $ch = ord($data{$i});
                if ($ch < 9 || $ch > 119) continue;

                $data{$i} = chr($ch + rand(-8, 8));
            }
        }

        /**
        * Generate an mp3 file by concatenating individual files
        * @since 1.0.4
        * @access private
        * @param array $letters  Array of letters to build a file from
        * @return string  MP3 file data
        */
        function generateMP3($letters)
        {
            $data_len    = 0;
            $files       = array();
            $out_data    = '';

            foreach ($letters as $letter) {
                $filename = $this->audio_path . strtoupper($letter) . '.mp3';

                $fp   = fopen($filename, 'rb');
                $data = fread($fp, filesize($filename)); // read file in

                $this->scrambleAudioData($data, 'mp3');
                $out_data .= $data;

                fclose($fp);
            }


            return $out_data;
        }

        /**
        * Generate random number less than 1
        * @since 2.0
        * @access private
        * @return float
        */
        function frand()
        {
            return 0.0001*rand(0,9999);
        }

        /**
        * Print signature text on image
        *
        * @since 2.0
        * @access private
        *
        */
        function addSignature()
        {
            if ($this->use_gd_font) {
                imagestring($this->im, 5, $this->image_width - (strlen($this->image_signature) * 10), $this->image_height - 20, $this->image_signature, $this->gdsignaturecolor);
            } else {

                $bbox = imagettfbbox(10, 0, $this->signature_font, $this->image_signature);
                $textlen = $bbox[2] - $bbox[0];
                $x = $this->image_width - $textlen - 5;
                $y = $this->image_height - 3;

                imagettftext($this->im, 10, 0, $x, $y, $this->gdsignaturecolor, $this->signature_font, $this->image_signature);
            }
        }

        /**
        * Get hashed IP address of remote user
        * 
        * @access private
        * @since 2.0.1
        * @return string
        */
        function getIPHash()
        {
            return strtolower(md5($_SERVER['REMOTE_ADDR']));
        }



        function outputAudioFile()
        {
            if (strtolower($this->audio_format) == 'wav') {
                header('Content-type: audio/x-wav');
                $ext = 'wav';
            } else {
                header('Content-type: audio/mpeg'); // default to mp3
                $ext = 'mp3';
            }

            header("Content-Disposition: attachment; filename=\"securimage_audio.{$ext}\"");
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Expires: Sun, 1 Jan 2000 12:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');

            $audio = $this->getAudibleCode($ext);

            header('Content-Length: ' . strlen($audio));

            echo $audio;
            exit;
        }
        /**
        * Get hashed IP address of remote user
        * 
        * @access private
        * @since 2.0.1
        * @return string
        */
        function getIPHash()
        {
            return strtolower(md5($_SERVER['REMOTE_ADDR']));
        }

        /**
        * Open SQLite database
        * 
        * @access private
        * @since 2.0.1
        * @return bool true if database was opened successfully
        */
        function openDatabase()
        {
            $this->sqlite_handle = false;

            if ($this->use_sqlite_db && function_exists('sqlite_open')) {
                $this->sqlite_handle = sqlite_open($this->sqlite_database, 0666, $error);

                if ($this->sqlite_handle !== false) {
                    $res = sqlite_query($this->sqlite_handle, "PRAGMA table_info(codes)");
                    if (sqlite_num_rows($res) == 0) {
                        sqlite_query($this->sqlite_handle, "CREATE TABLE codes (iphash VARCHAR(32) PRIMARY KEY, code VARCHAR(32) NOT NULL, created INTEGER)");
                    }
                }

                return $this->sqlite_handle != false;
            }

            return $this->sqlite_handle;
        }

        /**
        * Save captcha code to sqlite database
        * 
        * @access private
        * @since 2.0.1
        * @return bool true if code was saved, false if not
        */
        function saveCodeToDatabase()
        {
            $success = false;

            $this->openDatabase();

            if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
                $ip = $this->getIPHash();
                $time = time();
                $code = $_SESSION['securimage_code_value']; // hash code for security - if cookies are disabled the session still exists at this point
                $success = sqlite_query($this->sqlite_handle, "INSERT OR REPLACE INTO codes(iphash, code, created) VALUES('$ip', '$code', $time)");
            }

            return $success !== false;
        }

        /**
        * Get stored captcha code from sqlite database based on ip address hash
        * 
        * @access private
        * @since 2.0.1
        * @return string captcha code
        */
        function getCodeFromDatabase()
        {
            $code = '';

            if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
                $ip = $this->getIPHash();

                $res = sqlite_query($this->sqlite_handle, "SELECT * FROM codes WHERE iphash = '$ip'");
                if ($res && sqlite_num_rows($res) > 0) {
                    $res = sqlite_fetch_array($res);

                    if ($this->isCodeExpired($res['created']) == false) {
                        $code = $res['code'];
                    }
                }
            }

            return $code;
        }

        /**
        * Delete a code from the database by ip address hash
        * 
        * @access private
        * @since 2.0.1
        */
        function clearCodeFromDatabase()
        {
            if ($this->sqlite_handle !== false) {
                $ip = $this->getIPHash();

                sqlite_query($this->sqlite_handle, "DELETE FROM codes WHERE iphash = '$ip'");
            }
        }




    }

?>