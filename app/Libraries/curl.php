<?php

namespace App\Libraries;

class curl
{

    /**
     * @var mixed
     */
    public $call;
    /**
     * @var mixed
     */
    public $info;
    /**
     * @var mixed
     */
    public $header_size;
    /**
     * @var mixed
     */
    public $header;
    /**
     * @var mixed
     */
    public $body;
    /**
     * @var mixed
     */
    public $status;
    /**
     * @var mixed
     */
    public $err_no;
    /**
     * @var mixed
     */
    public $err_msg;

    /**
     * @param $url
     * @param $data
     * @param $timeount
     * @return mixed
     */
    public function post_contents($url, $data = "", $timeount = 15)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $http_response = curl_exec($ch);
        if (curl_errno($ch)) {
            $errno = curl_errno($ch);
            $errmsg = curl_error($ch);
            curl_close($ch);
            unset($ch);

            return false;
        }

        return $http_response;
    }

    /**
     * @param $url
     * @param $body
     * @param $headers
     * @return mixed
     */
    public function post($url, $body, $headers = null)
    {
        if (is_array($body)) {
            $body = http_build_query($body);
        }
        $curl_opts = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 2,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_RETURNTRANSFER => true,
        );
        if ($headers) {
            $curl_opts[CURLOPT_HTTPHEADER] = $headers;
        }
        $this->call = $this->init($curl_opts);

        return $this;
    }

    /**
     * @param $url
     * @param $headers
     * @return mixed
     */
    public function get($url, $headers = null)
    {
        $curl_opts = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 2,
            CURLOPT_RETURNTRANSFER => true,
        );
        if ($headers) {
            $curl_opts[CURLOPT_HTTPHEADER] = $headers;
        }
        $this->call = $this->init($curl_opts);

        return $this;
    }

    /**
     * @param $curl_opts
     */
    public function init($curl_opts)
    {
        if (!$curl_opts) {
            return false;
        }
        $ch = curl_init();
        if (!$ch) {
            return false;
        }
        curl_setopt_array($ch, $curl_opts);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300); //timeout in seconds
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $this->err_no = curl_errno($ch);
            $this->err_msg = curl_error($ch);
            curl_close($ch);
            unset($ch);

            return false;
        }
        $this->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->info = curl_getinfo($ch);
        $this->header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $this->header = substr($response, 0, $this->header_size);
        $this->body = substr($response, $this->header_size);
        curl_close($ch);
        unset($ch);

        return true;
    }

    /**
     * @return mixed
     */
    public function result()
    {
        return $this->body;
    }

    public function result_text()
    {
        return strip_tags($this->body);
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * @return mixed
     */
    public function header()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->status;
    }

    public function json_result()
    {
        return json_decode($this->result_text());
    }

    public function json_resultv2()
    {
        return json_decode($this->result());
    }

  

}
