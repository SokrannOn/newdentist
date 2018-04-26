<?php
    namespace App;

    use Carbon\Carbon;

    class Rounding {

        public static function roundUp($value,$choice){

            if($value){
                if(strtolower($choice) == 'l'){
                    $choice="localecurrency";
                }else{
                    $choice="default";
                }
                $cur = Currency::where($choice,1)->get();
                $decimal = null;
                $rounding = null;
                foreach($cur as $c){
                    $decimal = $c->decimalplace;
                    $rounding = $c->rounding;
                }
                $afterRound = round($value,$decimal);
                $divide = floor($afterRound/$rounding);

                $round = round($afterRound-($divide*$rounding),$decimal);
                if($round==0){
                    return $value;
                }else{
                    return number_format( ($divide*$rounding)+$rounding,$decimal);
                }
            }else{
                return "0";
            }
        }

        public static function roundDown($value,$choice){
            $cur = Currency::where('default',1)->get();
            $decimal = null;
            $rounding = null;
            if(strtolower($choice) == 'l'){
                $choice="localecurrency";
            }else{
                $choice="default";
            }
            $cur = Currency::where($choice,1)->get();
            foreach($cur as $c){
                $decimal = $c->decimalplace;
                $rounding = $c->rounding;
            }
            $afterRound = round($value,$decimal);
            $divide = floor($afterRound/$rounding);
            $round = round($afterRound-($divide*$rounding),$decimal);
            if($round==0){
                return $value;
            }else{
                return ($divide*$rounding);
            }
        }

        public static function getName(){
           return Currency::where('default',1)->value('engname');
        }

        public static function getDefaultCurrencyId(){
            return Currency::where('default',1)->value('id');
        }

        public static function getExchangeRate(){
            $now = Carbon::now()->toDateString();
            $id = Currency::where('default',1)->value('id');
            $ex = Exchange::where([['currency_id',$id],['date','>=',$now]])->value('buyrate');
            if($ex){
                $ex =$ex;
            }else{
                $ex = Exchange::where('currency_id',$id)->latest()->value('buyrate');
            }
            return $ex;
        }

        public static function postedAmount($value,$choice){

            $buyrate =1;
            $ex=self::getExchangeRate();
            $p=  $ex * $value;
            if(strtolower($choice)=='u'){
                $posted = self::roundUp($p,"l");
            }else{
                $posted = self::roundDown($p,"l");
            }
           return $posted;
        }
    }
