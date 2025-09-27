<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayController extends Controller
{
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ]
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function generateUUID()
    {
        return bin2hex(random_bytes(16)); // tạo random string giống UUID
    }

    public function momo_payment(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }

        $endpoint    = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMO";
        $accessKey   = "F8BBA842ECF85";
        $secretKey   = "K951B6PE1waDMi640xX08PD3vg6EkVlz";

        $orderInfo   = "Thanh toán đơn hàng #" . $order->id;
        // $amount = (string)intval($order->total_price);
        $amount = '10000';
        $orderId     = $this->generateUUID();
        $requestId   = $this->generateUUID();
        $redirectUrl = "http://shop.test/cart";
        $ipnUrl      = "http://shop.test/cart";
        $extraData   = "";
        $requestType = "captureWallet"; // dùng ví MoMo

        // Tạo chữ ký
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId'     => "MomoTestStore",
            'requestId'   => $requestId,
            'amount'      => $amount,
            'orderId'     => $orderId,
            'orderInfo'   => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl'      => $ipnUrl,
            'lang'        => "vi",
            'extraData'   => $extraData,
            'requestType' => $requestType,
            'signature'   => $signature
        ];

        $result     = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

// dd($data, $rawHash, $signature);

        if (isset($jsonResult['payUrl'])) {
            return redirect()->away($jsonResult['payUrl']);
        } else {
            // debug lỗi nếu MoMo trả về error
            // dd($jsonResult);
        }
    }
}
