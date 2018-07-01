<?php

namespace Anwar\Abkash;

use App\Http\Controllers\Controller;

class AbkashController extends Controller
{
    /*
        * bKAsh Marchecnt api
    */
    protected $bkash_api_base = 'http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg';

    /*
        *  Verified bKash payment transaction number
    */

    public function check_tarnsaction($transaction_number)
    {
        $data = [
            'user'   => config('Abkash.username'),
            'pass'   => config('Abkash.password'),
            'msisdn' => config('Abkash.mobile'),
            'trxid'  => $transaction_number,
        ];

        //run curl and get return

        $this->validate_response($this->curlinit($data));
    }

    /*
        // Get marchent information
    */

    public function curlinit($data)
    {
        $sweet = curl_init();
        curl_setopt($sweet, CURLOPT_URL, $this->bkash_api_base);
        curl_setopt($sweet, CURLOPT_POST, 1);
        curl_setopt($sweet, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($sweet, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($sweet);
        curl_close($sweet);

        return json_decode($response);
    }

    /*
        *  Validate return response
    */

    public function validate_response($abkashresponse)
    {
        if (is_null($abkashresponse)) {
            return 'Config Error . Please Contact with Support';
        }
        switch ($abkashresponse->trxStatus) {
        case '0010':
        case '0011':
            throw new Exception('Transaction is pending, please try again later.');
            break;
        case '0100':
            throw new Exception('Transaction ID is valid but transaction has been reversed.');
            break;
        case '0111':
            throw new Exception('Transaction is failed.');
            break;
        case '1001':
            throw new Exception('Invalid MSISDN input. Try with correct mobile no.');
            break;
        case '1002':
            throw new Exception('Invalid transaction ID.');
            break;
        case '1003':
            throw new Exception('Authorization Error, please contact site admin.');
            break;
        case '1004':
            throw new Exception('Transaction ID not found.');
            break;
        case '9999':
            throw new Exception('System error, could not process request. Please contact site admin.');
            break;
        case '0000':
            return $response;
        }
    }
}
