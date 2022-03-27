<?php

namespace App\Controllers;

use DateTime;
use Exception;

date_default_timezone_set("Asia/Jakarta");

class DeliveryController extends BaseController
{
    private $api_key = "d1c412d73fa9d0efd9af96d68be69c3b";

    public function getProvinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $result = $array_response['rajaongkir']['results'];
            $list = array();
            for ($i = 0; $i < count($result); $i++) {
                $list[$i]['id'] = $result[$i]['province_id'];
                $list[$i]['text'] = $result[$i]['province'];
            }

            return json_encode($list);
        }
    }

    public function getCity($province_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $province_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $result = $array_response['rajaongkir']['results'];
            $list = array();
            for ($i = 0; $i < count($result); $i++) {
                $list[$i]['id'] = $result[$i]['city_id'];
                $list[$i]['text'] = $result[$i]['city_name'];
            }

            return json_encode($list);
        }
    }

    public function getService($destination_id, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=457&destination=" . $destination_id . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->api_key"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $result = $array_response['rajaongkir']['results'];
            $list = array();
            for ($i = 0; $i < count($result[0]['costs']); $i++) {
                $list[$i]['id'] = $result[0]['costs'][$i]['cost'][0]['value'];
                $list[$i]['text'] = $result[0]['costs'][$i]['service'];
            }

            return json_encode($list);
        }
    }
}
