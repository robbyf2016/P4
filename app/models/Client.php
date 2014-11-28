<?php

class Client extends Eloquent {

	public function orders() {
        return $this->hasMany('Order');
    }

}