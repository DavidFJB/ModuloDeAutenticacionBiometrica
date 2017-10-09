<?php

class VoiceIt {

    public $developerId;
    public $platformId = "6";

    function __construct() {

        $this->developerId = "ae6e25717c44451280823f8615ed454a";
        
    }

    public function createUser($mail, $passwd, $firstName, $lastName, $phone1 = "", $phone2 = "", $phone3 = "") {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/users';
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'VsitFirstName: ' . $firstName;
        $headr[] = 'VsitLastName: ' . $lastName;
        $headr[] = 'VsitPhone1: ' . $phone1;
        $headr[] = 'VsitPhone2: ' . $phone2;
        $headr[] = 'VsitPhone3: ' . $phone3;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_POST, true);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function getUser($mail, $passwd) {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/users';
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'PlatformID: ' . $this->platformId;
        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_HTTPGET, true);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function setUser($mail, $passwd, $firstName, $lastName, $phone1 = "", $phone2 = "", $phone3 = "") {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/users';
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'VsitFirstName: ' . $firstName;
        $headr[] = 'VsitLastName: ' . $lastName;
        $headr[] = 'VsitPhone1: ' . $phone1;
        $headr[] = 'VsitPhone2: ' . $phone2;
        $headr[] = 'VsitPhone3: ' . $phone3;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_PUT, true);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function deleteUser($mail, $passwd) {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/users';
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

        $reply = curl_exec($crl);
        return $reply;
    }

    public function createEnrollment($mail, $passwd, $pathToEnrollmentWav, $contentLanguage = "") {
        $data = file_get_contents($pathToEnrollmentWav);
        $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
        $headr = array();
        $headr[] = 'X-Requested-With: JSONHttpRequest';
        $headr[] = 'Content-Type: audio/wav';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'ContentLanguage: ' . $contentLanguage;
       /* $headr[] = 'VsitFirstName: ' . $firstName;
        $headr[] = 'VsitLastName: ' . $lastName;
        $headr[] = 'VsitPhone1: ' . $phone1;
        $headr[] = 'VsitPhone2: ' . $phone2;
        $headr[] = 'VsitPhone3: ' . $phone3;
        $headr[] = 'PlatformID: ' . $this->platformId;*/

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function createEnrollmentByWavURL($mail, $passwd, $urlToEnrollmentWav, $contentLanguage = "") {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments/bywavurl';
        $headr = array();
        $headr[] = 'X-Requested-With: JSONHttpRequest';
        $headr[] = 'Content-Type: audio/wav';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'ContentLanguage: ' . $contentLanguage;
        $headr[] = 'VsitwavURL: ' . $urlToEnrollmentWav;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function deleteEnrollment($mail, $passwd, $enrollmentId) {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments' . '/' . $enrollmentId;
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'PlatformID: ' . $this->platformId;


        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

        $reply = curl_exec($crl);
        return $reply;
        
        
    }

    public function getEnrollments($mail, $passwd) {
        $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_HTTPGET, true);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function authentication($mail, $passwd, $pathToAuthenticationWav, $confidence, $contentLanguage = "") {
        $data = file_get_contents($pathToAuthenticationWav);
        $url = 'https://siv.voiceprintportal.com/sivservice/api/authentications';
        $headr = array();
        $headr[] = 'X-Requested-With: JSONHttpRequest';
        $headr[] = 'Content-Type: audio/wav';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'VsitConfidence: ' . $confidence;
        $headr[] = 'ContentLanguage: ' . $contentLanguage;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        $reply = curl_exec($crl);
        return $reply;
    }

    public function authenticationByWavURL($mail, $passwd, $urlToAuthenticationWav, $confidence, $contentLanguage = "") {

        $url = 'https://siv.voiceprintportal.com/sivservice/api/authentications/bywavurl';
        $headr = array();
        $headr[] = 'X-Requested-With: JSONHttpRequest';
        $headr[] = 'Content-Type: audio/wav';
        $headr[] = 'VsitEmail: ' . $mail;
        $headr[] = 'VsitPassword: ' . hash('sha256', $passwd);
        $headr[] = 'VsitDeveloperId: ' . $this->developerId;
        $headr[] = 'VsitConfidence: ' . $confidence;
        $headr[] = 'ContentLanguage: ' . $contentLanguage;
        $headr[] = 'VsitwavURL: ' . $urlToAuthenticationWav;
        $headr[] = 'PlatformID: ' . $this->platformId;

        //cURL starts
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        $reply = curl_exec($crl);
        return $reply;
    }

}


?>
