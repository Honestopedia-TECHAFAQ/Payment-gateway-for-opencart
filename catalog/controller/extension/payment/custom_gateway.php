<?php
class ControllerExtensionPaymentCustomGateway extends Controller {
    public function index() {
        $this->load->language('extension/payment/custom_gateway');
        $data['button_confirm'] = $this->language->get('button_confirm');
        return $this->load->view('extension/payment/custom_gateway', $data);
    }

    public function confirm() {
        $this->load->model('checkout/order');
        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);
        $payment_response = $this->makePayment($order_info);

        if ($payment_response['success']) {
            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_custom_gateway_order_status_id'));
            $this->response->redirect($this->url->link('checkout/success'));
        } else {
            $this->response->redirect($this->url->link('checkout/failure'));
        }
    }

    private function makePayment($order_info) {
        // Simulated payment gateway API request
        // Implement actual API logic here
        return ['success' => true, 'transaction_id' => '123456'];
    }
}
