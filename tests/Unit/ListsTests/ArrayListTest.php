<?php

describe('ArrayList', function () {
    it('should be instance of ArrayList', function () {
        $arrayList = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        expect($arrayList)->toBeInstanceOf(\Opmvpc\StructuresDonnees\Lists\ListInterface::class);
        expect($arrayList)->toBeInstanceOf(\Opmvpc\StructuresDonnees\Lists\ArrayList::class);
    });

    it('should push element', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        expect($list->size())->toBe(3);
        expect($list->get(0))->toBe(1);
        expect($list->get(1))->toBe(2);
        expect($list->get(2))->toBe(3);
    });

    it('should remove element', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        $list->remove(2);
        expect($list->size())->toBe(2);
        expect($list->get(0))->toBe(1);
        expect($list->get(1))->toBe(2);
    });

    it('should clear list', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        $list->clear();
        expect($list->size())->toBe(0);
    });

    it('should check if list contains element', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        expect($list->includes(2))->toBe(true);
        expect($list->includes(4))->toBe(false);
    });

    it('should get the index of an element', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        expect($list->indexOf(2))->toBe(1);
    });

    it('should check if list is empty', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        expect($list->isEmpty())->toBe(true);
        $list->push(1);
        expect($list->isEmpty())->toBe(false);
    });

    it('should convert list to array', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        expect($list->toArray())->toBe([1, 2, 3]);
    });

    it('should convert list to string', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        expect($list->__toString())->toBe("[\n    1,\n    2,\n    3\n]");
    });

    it('should mix push and remove', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        $list->remove(2);
        $list->push(4);
        $list->push(5);
        $list->remove(1);
        $list->remove(2);
        expect($list->size())->toBe(2);
        expect($list->get(0))->toBe(1);
    });

    it('should push and remove 100 elements', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        for ($i = 0; $i < 100; ++$i) {
            $list->push($i);
        }
        expect($list->size())->toBe(100);
        for ($i = 0; $i < 100; ++$i) {
            $list->remove(0);
        }
        expect($list->size())->toBe(0);
    });

    it('should push and remove objects', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(new \Opmvpc\StructuresDonnees\Lists\ArrayList());
        $list->push(new \Opmvpc\StructuresDonnees\Lists\ArrayList());
        $list->push(new \Opmvpc\StructuresDonnees\Lists\ArrayList());
        expect($list->size())->toBe(3);
        $list->remove(1);
        expect($list->size())->toBe(2);
    });

    it('should throw exception when get index not found', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->get(0);
    })->throws(\Exception::class);


    it('should throw exception when set index not found', function () {
        $collection = new \Opmvpc\StructuresDonnees\Lists\Collection();
        $collection->set(0, 1);
    })->throws(\Exception::class);


    it('should throw exception when remove index not found', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->remove(0);
    })->throws(\Exception::class);

    it('should throw exception when index of element not found', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->indexOf(0);
    })->throws(\Exception::class);

    it('should return an error if adding an element of a different type', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push('2');
    })->throws(\InvalidArgumentException::class);

    it('should reindex keys after delete', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        $list->remove(1);
        expect($list->get(0))->toBe(1);
        expect($list->get(1))->toBe(3);
    });

    it('should work with mixed calls', function () {
        $list = new \Opmvpc\StructuresDonnees\Lists\ArrayList();
        $list->push(1);
        expect($list->get(0))->toBe(1);
        $list->push(2);
        expect($list->get(1))->toBe(2);
        $list->push(3);
        expect($list->get(2))->toBe(3);
        $list->remove(2);
        expect($list->size())->toBe(2);
        expect($list->get(0))->toBe(1);
        expect($list->get(1))->toBe(2);

        $list->push(4);
        expect($list->get(2))->toBe(4);
        $list->push(5);
        expect($list->get(3))->toBe(5);
        $list->remove(1);
        expect($list->size())->toBe(3);
        expect($list->get(0))->toBe(1);
        expect($list->get(1))->toBe(4);
        expect($list->get(2))->toBe(5);
    });
});