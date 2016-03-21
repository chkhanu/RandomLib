<?php

namespace RandomLib\Source;

use SecurityLib\Strength;
use SecurityLib\Util;

class UniqIDTest extends \PHPUnit_Framework_TestCase {

    public static function provideGenerate() {
        $data = array();
        for ($i = 0; $i < 100; $i += 5) {
            $not = $i > 0 ? str_repeat(chr(0), $i) : chr(0);
            $data[] = array($i, $not);
        }
        return $data;
    }

    /**
     */
    public function testGetStrength() {
        $strength = new Strength(Strength::LOW);
        $actual = UniqID::getStrength();
        $this->assertEquals($actual, $strength);
    }

    /**
     * @dataProvider provideGenerate
     */
    public function testGenerate($length, $not) {
        $rand = new UniqID;
        $stub = $rand->generate($length);
        $this->assertEquals($length, Util::safeStrlen($stub));
        $this->assertNotEquals($not, $stub);
    }

}
