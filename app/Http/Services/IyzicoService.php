<?php

namespace App\Services;

use App\Models\Order;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;

class IyzicoService
{
    protected $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setApiKey(config('services.iyzico.api_key'));
        $this->options->setSecretKey(config('services.iyzico.secret_key'));
        $this->options->setBaseUrl(config('services.iyzico.base_url'));
    }

    public function createPaymentForm(Order $order)
    {
        $request = new CreateCheckoutFormInitializeRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($order->order_number);
        $request->setPrice($order->total);
        $request->setPaidPrice($order->total);
        $request->setCurrency(Currency::TL);
        $request->setBasketId($order->order_number);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl(route('payment.callback'));
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        // Buyer (Alıcı) Bilgileri
        $buyer = new Buyer();
        $buyer->setId($order->user->user_id);
        $buyer->setName($order->user->name);
        $buyer->setSurname('');  // Kullanıcı modelinde surname yoksa boş bırakılabilir
        $buyer->setGsmNumber($order->phone);
        $buyer->setEmail($order->user->email);
        $buyer->setIdentityNumber('11111111111');  // TC Kimlik no
        $buyer->setRegistrationAddress($order->address);
        $buyer->setCity($order->city);
        $buyer->setCountry("Turkey");
        $request->setBuyer($buyer);

        // Shipping (Teslimat) Adresi
        $shippingAddress = new Address();
        $shippingAddress->setContactName($order->user->name);
        $shippingAddress->setCity($order->city);
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress($order->address);
        $request->setShippingAddress($shippingAddress);

        // Billing (Fatura) Adresi
        $billingAddress = new Address();
        $billingAddress->setContactName($order->user->name);
        $billingAddress->setCity($order->city);
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress($order->address);
        $request->setBillingAddress($billingAddress);

        // Basket Items (Sepet Ürünleri)
        $basketItems = array();
        foreach ($order->items as $item) {
            $basketItem = new BasketItem();
            $basketItem->setId($item->product->product_id);
            $basketItem->setName($item->product->name);
            $basketItem->setCategory1($item->product->category->name);
            $basketItem->setItemType(BasketItemType::PHYSICAL);
            $basketItem->setPrice($item->price * $item->quantity);
            $basketItems[] = $basketItem;
        }
        $request->setBasketItems($basketItems);

        return CheckoutFormInitialize::create($request, $this->options);
    }
}
