<?php

namespace App\Model\Entity;

trait SoftDeleteTrait {

    public function softDelete() {
        $this->set('is_del', true);
    }

}
