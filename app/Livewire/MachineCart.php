<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Machine\Entities\Machine;

class MachineCart extends Component
{

    public $listeners = ['productSelected', 'inputDyrtState'];

    public $cart_instance;

    public $data;
    public $type_dirt;
    public $state_rumed;
    public $type_process;
    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $item_outside_company;
    public $item_area;


    public $unit_price;

    
    private $product;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->unit_price[$cart_item->id] = $cart_item->price; // se añade
                $this->item_outside_company[$cart_item->id] = $cart_item->options->product_outside_company; // se añade
                $this->item_area[$cart_item->id] = $cart_item->options->product_area; // se añade
                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->type_dirt[$cart_item->id] = $cart_item->options->product_type_dirt;
                $this->state_rumed[$cart_item->id] = $cart_item->options->product_state_rumed;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
                

            }
        } else {
            
            $this->type_dirt = [];
            $this->state_rumed = [];
            $this->type_process = [];
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = []; // se añade
            $this->item_outside_company = []; // se añade
            $this->item_area = []; // se añade



        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-cart', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($product)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id == $product['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->product = $product;

        $cart->add([
            'id'      => $product['id'],
            'name'    => $product['product_name'],
            'qty'     => $product['product_quantity'],
            'price'     => $this->calculate($product)['price'],
            'weight'     => 1,

            'options' => [
                'sub_total'             => $this->calculate($product)['sub_total'], // se añade
                'unit_price'            => $this->calculate($product)['unit_price'], // se añade
                'unit'                  => $product['product_unit'], // se añade
                'code'    => $product['product_code'],
                'product_type_process'    => $product['product_type_process'],
                'product_patient'    => $product['product_patient'],
                'product_area'    => $product['area'],
                'product_type_dirt' => 'CRITICO', //ESTE ES EL DATO A MODIFICAR
                'product_state_rumed' => 'BUENO' //ESTE ES EL DATO A MODIFICAR
            ]

        ]);
        $this->item_patient[$product['id']] = $product['product_patient'];
        $this->item_area[$product['id']] = $product['area'];
        $this->item_outside_company[$product['id']] = '';
        $this->check_quantity[$product['id']] = $product['product_quantity'];
        $this->quantity[$product['id']] = 1;
        $this->type_dirt[$product['id']] = 'CRITICO';
        $this->state_rumed[$product['id']] = 'BUENO';
    }

    public function updateQuantity($row_id, $product_id) {
      

        Cart::instance($this->cart_instance)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'product_quantity'             => $cart_item->qty,
                'sub_total'             => $cart_item->price *$cart_item->qty , // se añade
                'unit'                  => $cart_item->options->unit, // se añade
                'unit_price'            => $cart_item->options->unit_price, // se añade
                'code'                   => $cart_item->options->code,
                'product_type_dirt'      => $cart_item->options->product_type_dirt,
                'product_state_rumed'    => $cart_item->options->product_state_rumed,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_patient'    => $cart_item->options->product_patient,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,


            ]
        ]);
    }


    public function calculate($product, $new_price = null)
    {
        if ($new_price) {
            $product_price = $new_price;
        } else {
            $this->unit_price[$product['id']] = $product['product_price'];
            $product_price = $this->unit_price[$product['id']];
            $this->quantity[$product['id']] = $product['product_quantity'];
            $product_quantity =  $this->quantity[$product['id']];
        }

        $price = 0;
        $unit_price = 0;
        $sub_total = 0;

        $price = $product_price;
        $unit_price = $product_price;
        $sub_total = $product_quantity;

        return ['price' => $price, 'unit_price' => $unit_price, 'sub_total' => $sub_total];
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }
  
    public function inputDyrtState($product_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $product_id); // se añade
    } // se añade

    




    public function updateDataInput($row_id, $product_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'product_quantity'             => $cart_item->qty,
                'code'                   => $cart_item->options->code,
                'product_type_dirt'      => $cart_item->options->product_type_dirt,
                'product_state_rumed'    => $cart_item->options->product_state_rumed,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_patient'    => $cart_item->options->product_patient,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'sub_total'             => $cart_item->price *$cart_item->qty , // se añade
                'unit'                  => $cart_item->options->unit, // se añade
                'unit_price'            => $cart_item->options->unit_price, // se añade

            ]
        ]);
    }

    public function setProductoptions($row_id, $product_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $product_id, $cart_item);
  

        session()->flash('message_inputDyrtState' . $product_id, 'Observaciones añadidos...!');
    }


    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code'                  => $cart_item->options->code,
            'product_quantity'             => $cart_item->qty,
            'product_type_process'=> $cart_item->options->product_type_process,
            'product_type_dirt'     => $this->type_dirt[$product_id],
            'product_state_rumed'   => $this->state_rumed[$product_id],
            'product_patient'   => $this->item_patient[$product_id],
            'product_area'   => $this->item_area[$product_id],
            'product_outside_company'   => $this->item_outside_company[$product_id],
            'sub_total'             => $cart_item->price * $cart_item->qty,
            'unit_price'            => $cart_item->options->unit_price,
        ]]);
    }
}
