<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $crypto = json_decode('["BTC","ETH","BNB","XRP","USDT","ADA","DOT","UNI","LTC","LINK","DOGE","BCH","XLM","THETA","VET","FIL","USDC","TRX","WBTC","EOS","SOL","KLAY","BSV","CRO","IOST","LUNA","XMR","ATOM","AAVE","BUSD","FTT","BTT","XTZ","AVAX","NEO","ALGO","KSM","EGLD","XEM","HT","RUNE","CAKE","HOT","BTCB","DAI","DASH","HBAR","CHZ","MKR","ZEC"]');


        $fiat = json_decode('["USD","KRW","INR","THB","JPY"]');

        $cryptoDetails = (array)json_decode('{"BTC":{"img":"1.png","name":"Bitcoin"},"ETH":{"img":"1027.png","name":"Ethereum"},"BNB":{"img":"1839.png","name":"BinanceCoin"},"XRP":{"img":"52.png","name":"XRP"},"USDT":{"img":"825.png","name":"Tether"},"ADA":{"img":"2010.png","name":"Cardano"},"DOT":{"img":"6636.png","name":"Polkadot"},"UNI":{"img":"7083.png","name":"Uniswap"},"LTC":{"img":"2.png","name":"Litecoin"},"LINK":{"img":"1975.png","name":"Chainlink"},"DOGE":{"img":"74.png","name":"Dogecoin"},"BCH":{"img":"1831.png","name":"BitcoinCash"},"XLM":{"img":"512.png","name":"Stellar"},"THETA":{"img":"2416.png","name":"THETA"},"VET":{"img":"3077.png","name":"VeChain"},"FIL":{"img":"2280.png","name":"Filecoin"},"USDC":{"img":"3408.png","name":"USDCoin"},"TRX":{"img":"1958.png","name":"TRON"},"WBTC":{"img":"3717.png","name":"WrappedBitcoin"},"SOL":{"img":"5426.png","name":"Solana"},"EOS":{"img":"1765.png","name":"EOS"},"KLAY":{"img":"4256.png","name":"Klaytn"},"BSV":{"img":"3602.png","name":"BitcoinSV"},"LUNA":{"img":"4172.png","name":"Terra"},"MIOTA":{"img":"1720.png","name":"IOTA"},"CRO":{"img":"3635.png","name":"Crypto.comCoin"},"XMR":{"img":"monero.png","name":"Monero"},"ATOM":{"img":"3794.png","name":"Cosmos"},"AAVE":{"img":"7278.png","name":"Aave"},"BUSD":{"img":"4687.png","name":"BinanceUSD"},"FTT":{"img":"4195.png","name":"FTXToken"},"BTT":{"img":"3718.png","name":"BitTorrent"},"XTZ":{"img":"2011.png","name":"Tezos"},"AVAX":{"img":"5805.png","name":"Avalanche"},"NEO":{"img":"1376.png","name":"Neo"},"ALGO":{"img":"4030.png","name":"Algorand"},"KSM":{"img":"5034.png","name":"Kusama"},"EGLD":{"img":"6892.png","name":"Elrond"},"XEM":{"img":"873.png","name":"NEM"},"HT":{"img":"2502.png","name":"HuobiToken"},"RUNE":{"img":"4157.png","name":"THORChain"},"CAKE":{"img":"7186.png","name":"PancakeSwap"},"BTCB":{"img":"4023.png","name":"BitcoinBEP2"},"DAI":{"img":"4943.png","name":"Dai"},"HOT":{"img":"2682.png","name":"Holo"},"DASH":{"img":"131.png","name":"Dash"},"CHZ":{"img":"4066.png","name":"Chiliz"},"MKR":{"img":"1518.png","name":"Maker"},"HBAR":{"img":"4642.png","name":"HederaHashgraph"},"ZEC":{"img":"1437.png","name":"Zcash"},"STX":{"img":"4847.png","name":"Stacks"},"COMP":{"img":"5692.png","name":"Compound"},"DCR":{"img":"1168.png","name":"Decred"},"ETC":{"img":"1321.png","name":"EthereumClassic"},"GRT":{"img":"6719.png","name":"TheGraph"},"ENJ":{"img":"2130.png","name":"EnjinCoin"},"SNX":{"img":"2586.png","name":"Synthetix"},"ZIL":{"img":"2469.png","name":"Zilliqa"},"NEAR":{"img":"6535.png","name":"NEARProtocol"},"SUSHI":{"img":"6758.png","name":"SushiSwap"},"BAT":{"img":"1697.png","name":"BasicAttentionToken"},"LEO":{"img":"3957.png","name":"UNUSSEDLEO"},"MATIC":{"img":"3890.png","name":"Polygon"},"NEXO":{"img":"2694.png","name":"Nexo"},"BTG":{"img":"2083.png","name":"BitcoinGold"},"RVN":{"img":"2577.png","name":"Ravencoin"},"IOST":{"img":"coin_17.png","name":"IOST"}}');


   $fiatDetails = (array)json_decode('{"USD":{"name":"UnitedStatesDollar","img":"USD Dollar.png","sname":"USD"},"KRW":{"name":"KoreanWon","img":"Korean Won.png","sname":"KRW"},"INR":{"name":"IndianRupee","img":"Indian Rupee.png","sname":"INR"},"THB":{"name":"ThaiBaht","img":"Thai Baht.png","sname":"THB"},"JPY":{"name":"JapaneseYen","img":"Japenese Yuan.png","sname":"JPY"} }'
     );


   foreach ($crypto as $key => $value) {

   	$currency= new \App\Models\Currency;

   	if(!$currency->where('short_name',$value)->exists())
   	{
       $row=array('short_name'=>$value,'type_id'=>1,'name'=>$cryptoDetails[$value]->name);

       $row=$currency::create($row);

        $media=\MediaUploader::fromSource(public_path('back/img/currencies/'.$cryptoDetails[$value]->img))
                               ->toDirectory('currency-icons')
                               ->upload();

              $row->attachMedia($media,'icon');

   	}


   	
   }

   // end cryto loop


   foreach ($fiat as $kk => $vv) {

   	$currency= new \App\Models\Currency;

   	if(!$currency->where('short_name',$vv)->exists())
   	{
       $row=array('short_name'=>$vv,'type_id'=>2,'name'=>$fiatDetails[$vv]->name);

       $row=$currency::create($row);

        $media=\MediaUploader::fromSource(public_path('back/img/currencies/'.$fiatDetails[$vv]->img))
                               ->toDirectory('currency-icons')
                               ->upload();

              $row->attachMedia($media,'icon');

   	}


   	
   }


    }
}
