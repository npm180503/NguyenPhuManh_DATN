<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $order = Order::where('order_code', $request->order_id)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }

        $endpoint    = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMO";
        $accessKey   = "F8BBA842ECF85";
        $secretKey   = "K951B6PE1waDMi640xX08PD3vg6EkVlz";

        $orderInfo   = "Thanh toán đơn hàng #" . $order->id;
        // $amount = (string)intval($order->total_price);
        $amount = (int) $order->total_price;
        $orderId     = $order->order_code;
        $requestId   = $this->generateUUID();
        $redirectUrl = route("fr.order.momo.callback");
        $ipnUrl      = route('momo.ipn');
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
            abort(404);
            // dd($jsonResult);
            // debug lỗi nếu MoMo trả về error
            // dd($jsonResult);
        }
    }

    public function momoIpn(Request $request)
    {
        $orderId = $request->input('orderId'); // chính là order_code bạn gửi đi
        $resultCode = $request->input('resultCode'); // 0 = thành công

        $order = Order::where('order_code', $orderId)->first();

        if ($order) {
            if ($resultCode == 0) {
                $order->payment_status = 'paid'; // thanh toán thành công
            } else {
                $order->payment_status = 'failed'; // thanh toán thất bại
            }
            $order->save();
        }

        // MoMo yêu cầu trả JSON
        return response()->json(['status' => 'ok']);
    }

    public function momoReturn(Request $request)
    {
        $orderId = $request->input('orderId');
        $resultCode = $request->input('resultCode');

        $order = Order::where('order_code', $orderId)->first();

        if ($order && $resultCode == 0) {
            return redirect()->route('order.success', ['code' => $order->order_code]);
        } else {
            return redirect()->route('order.failed');
        }
    }
}
