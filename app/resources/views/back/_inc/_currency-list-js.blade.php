<script type="text/javascript">
  
 const coinsList = [
    'BTC',
    'ETH',
    'BNB',
    'XRP',
    'USDT',
    'ADA',
    'DOT',
    'UNI',
    'LTC',
    'LINK',
    'DOGE',
    'BCH',
    'XLM',
    'THETA',
    'VET',
    'FIL',
    'USDC',
    'TRX',
    'WBTC',
    'EOS',
    'SOL',
    'KLAY',
    'BSV',
    'CRO',
    // 'MIOTA',
    'IOST',
    'LUNA',
    'XMR',
    'ATOM',
    'AAVE',
    'BUSD',
    'FTT',
    'BTT',
    'XTZ',
    'AVAX',
    'NEO',
    'ALGO',
    'KSM',
    'EGLD',
    'XEM',
    'HT',
    'RUNE',
    'CAKE',
    'HOT',
    'BTCB',
    'DAI',
    'DASH',
    'HBAR',
    'CHZ',
    'MKR',
    'ZEC',
  ];
  
  // export const exchangeList = ['BINANCE', 'COINBASE', 'BITKUB', 'GEMINI', 'BITHUMB', 'UPBIT', 'HUOBI', 'KRAKEN'];
   const exchangeList = [
      'OKEX',
      'POLONIEX',
      'HUOBIKR',
      'BITSTAMP',
      'KUCOIN',
      'BITFINEX',
      'SATANGPRO',
      'BINANCE',
      'COINBASE',
      'BITKUB',
      'GEMINI',
      'BITHUMB',
      'UPBIT',
      'HUOBI',
      'KRAKEN',
      'LIQUID',
      'KORBIT',
      'GATEIO',
      'CRYPTODOTCOM',
      'FTX',
      'ZAIF',
      'ASCENDEX',
      'COINLIST',
      'BIGONE',
      'PROBIT',
      'PROBITKR',
      'BITHUMBGLOBAL',
      'COINDCX',
      // 'LUNO',
      'EXMO',
      // 'ETORO',
      'OKCOIN',
      // 'COINCHECK',
      'BITTREX',
      'BITFLYER',
      'XT',
      'COINFLEX',
      'PARIBU',
      'BITBANK',
      'COINBITKR',
      'BTCTURK',
      'CURRENCYDOTCOM',
      'COINONEKR',
      'BITVAVO',
      'INDODAX',
      'COINEX',
      'HITBTC',
      // 'OKEXKR',
      'BITWELLEX',
      'ALTERDICE',
      'DIGIFINEX',
      'CEXIO',
      'WHITEBIT',
      'COINSBIT',
      'BITSO',
  ];
  
   const exchangeDetails = {
    "COINSBIT": {
        "img": "{{asset('back/img/currencies/460.png')}}",
        "name": "Coinsbit"
    },
    "WHITEBIT": {
        "img": "{{asset('back/img/currencies/501.png')}}",
        "name": "WhiteBIT"
    },
    "CEXIO": {
        "img": "{{asset('back/img/currencies/36.png')}}",
        "name": "CEX.IO"
    },
    "DIGIFINEX": {
        "img": "{{asset('back/img/currencies/407.png')}}",
        "name": "DigiFinex"
    },
    "ALTERDICE": {
        "img": "{{asset('back/img/currencies/481.png')}}",
        "name": "Alterdice"
    },
    "BITWELLEX": {
        "img": "{{asset('back/img/currencies/1186.png')}}",
        "name": "BitWell"
    },
    "EXMARKETS": {
        "img": "{{asset('back/img/currencies/535.png')}}",
        "name": "ExMarkets"
    },
    "OKEXKR": {
        "img": "{{asset('back/img/currencies/490.png')}}",
        "name": "OKEx Korea"
    },
    "HITBTC": {
        "img": "{{asset('back/img/currencies/42.png')}}",
        "name": "HitBTC"
    },
    "COINEX": {
        "img": "{{asset('back/img/currencies/350.png')}}",
        "name": "CoinEx"
    },
    "INDODAX": {
        "img": "{{asset('back/img/currencies/68.png')}}",
        "name": "Indodax"
    },
    "BITVAVO": {
        "img": "{{asset('back/img/currencies/520.png')}}",
        "name": "Bitvavo"
    },
    "COINONEKR": {
        "img": "{{asset('back/img/currencies/174.png')}}",
        "name": "Coinone"
    },
    "BTCTURK": {
        "img": "{{asset('back/img/currencies/243.png')}}",
        "name": "BtcTurk Pro"
    },
    "COINBITKR": {
        "img": "{{asset('back/img/currencies/442.png')}}",
        "name": "Coinbit"
    },
    "ITBIT": {
        "img": "{{asset('back/img/currencies/72.png')}}",
        "name": "itBit"
    },
    "CURRENCYDOTCOM": {
        "img": "{{asset('back/img/currencies/699.png')}}",
        "name": "Currency.com"
    },
    "PARIBU": {
        "img": "{{asset('back/img/currencies/225.png')}}",
        "name": "Paribu"
    },
    "BITBANK": {
        "img": "{{asset('back/img/currencies/257.png')}}",
        "name": "Bitbank"
    },
    "BIGONE": {
        "img": "{{asset('back/img/currencies/330.png')}}",
        "name": "BigONE"
    },
    "ZAIF": {
        "img": "{{asset('back/img/currencies/73.png')}}",
        "name": "Zaif"
    },
    "COINFLEX": {
        "img": "{{asset('back/img/currencies/538.png')}}",
        "name": "CoinFLEX"
    },
    "XT": {
        "img": "{{asset('back/img/currencies/525.png')}}",
        "name": "XT"
    },
    "BITTREX": {
        "img": "{{asset('back/img/currencies/22.png')}}",
        "name": "Bittrex"
    },
    "BITFLYER": {
        "img": "{{asset('back/img/currencies/139.png')}}",
        "name": "bitFlyer"
    },
    'OKEX': {
      img: '{{asset('back/img/currencies/294.png')}}',
      name: 'Okex',
    },
    'POLONIEX': {
      img: '{{asset('back/img/currencies/16.png')}}',
      name: 'Poloniex',
    },
    'HUOBIKR': {
      img: '{{asset('back/img/currencies/huobi.svg')}}',
      name: 'Huobi KR',
    },
    'BITSTAMP': {
      img: '{{asset('back/img/currencies/70.png')}}',
      name: 'Bitstamp',
    },
    'KUCOIN': {
      img: '{{asset('back/img/currencies/kucoin.svg')}}',
      name: 'Kucoin',
    },
    'BITFINEX': {
      img: '{{asset('back/img/currencies/bitfinex.svg')}}',
      name: 'Bitfinex',
    },
    'SATANGPRO': {
      img: '{{asset('back/img/currencies/325.png')}}',
      name: 'Satang Pro',
    },
    'BINANCE': {
      img: '{{asset('back/img/currencies/binance.svg')}}',
      name: 'Binance',
    },
    'COINBASE': {
      img: '{{asset('back/img/currencies/coinbase.svg')}}',
      name: 'Coinbase',
    },
    'BITKUB': {
      img: '{{asset('back/img/currencies/bitkub.svg')}}',
      name: 'Bitkub',
    },
    'GEMINI': {
      img: '{{asset('back/img/currencies/151.png')}}',
      name: 'Gemini',
    },
    'BITHUMB': {
      img: '{{asset('back/img/currencies/bithumb.svg')}}',
      name: 'Bithumb',
    },
    'UPBIT': {
      img: '{{asset('back/img/currencies/351.png')}}',
      name: 'Upbit',
    },
    'HUOBI': {
      img: '{{asset('back/img/currencies/huobi.svg')}}',
      name: 'Huobi',
    },
    'KRAKEN': {
      img: '{{asset('back/img/currencies/kraken.svg')}}',
      name: 'Kraken',
    },
    'LIQUID': {
      img: '{{asset('back/img/currencies/7650.png')}}',
      name: 'Liquid',
    },
    'KORBIT': {
      img: '{{asset('back/img/currencies/194.png')}}',
      name: 'Korbit',
    },
    'GATEIO': {
        "img": "{{asset('back/img/currencies/302.png')}}",
        "name": "Gate.io"
    },
    'COINCHECK': {
        "img": "{{asset('back/img/currencies/106.png')}}",
        "name": "Coincheck"
    },
    'CRYPTODOTCOM': {
        "img": "{{asset('back/img/currencies/1149.png')}}",
        "name": "Crypto.com"
    },
    'FTX': {
        "img": "{{asset('back/img/currencies/524.png')}}",
        "name": "FTX"
    },
    // 'ZAIF',
    'ASCENDEX': {
        "img": "{{asset('back/img/currencies/453.png')}}",
        "name": "AscendEX"
    },
    'COINLIST': {
        "img": "{{asset('back/img/currencies/1011.png')}}",
        "name": "Coinlist Pro"
    },
    'PROBIT': {
        "img": "{{asset('back/img/currencies/477.png')}}",
        "name": "ProBit"
    },
    'PROBITKR': {
        "img": "{{asset('back/img/currencies/477.png')}}",
        "name": "ProBit Korea"
    },
    'BITHUMBGLOBAL': {
        "img": "{{asset('back/img/currencies/489.png')}}",
        "name": "Bithumb Global"
    },
    'COINDCX': {
      "img": "{{asset('back/img/currencies/949.png')}}",
      "name": "CoinDCX"
    },
    // 'LUNO',
    'EXMO': {
        "img": "{{asset('back/img/currencies/50.png')}}",
        "name": "EXMO"
    },
    // 'ETORO',
    'OKCOIN': {
        "img": "{{asset('back/img/currencies/61.png')}}",
        "name": "OKCoin"
    },
    'BITSO': {
        "img": "{{asset('back/img/currencies/bitso.png')}}",
        "name": "Bitso"
    },
  };
  
   const currencySymbols = {
    'USD': '\u0024 ',
    'KRW': '\u20A9 ',
    'INR': '\u20B9 ',
    'THB': '\u0E3F ',
    'JPY': '\u00A5 ',
    'TRY': '\u20BA ',
  };
  
   const currencyDetails = {
    "USD": {
      "name": 'United States Dollar',
      "img": '{{asset('back/img/currencies/USD.svg')}}',
      "sname": 'USD',
    },
    "KRW": {
      "name": 'Korean Won',
      "img": '{{asset('back/img/currencies/KRW.svg')}}',
      "sname": 'KRW',
    },
    "INR": {
      "name": 'Indian Rupee',
      "img": '{{asset('back/img/currencies/inr.svg')}}',
      "sname": 'INR',
    },
    "THB": {
      "name": 'Thai Baht',
      "img": '{{asset('back/img/currencies/thb.svg')}}',
      "sname": 'THB',
    },
    "JPY": {
      "name": 'Japanese Yen',
      "img": '{{asset('back/img/currencies/jp.svg')}}',
      "sname": 'JPY',
    },
    "TRY": {
      "name": 'Turkish Lira',
      "img": '{{asset('back/img/currencies/tr.svg')}}',
      "sname": 'TRY',
    },
  };
  
   const currencyList = ['USD', 'KRW', 'INR', 'THB', 'JPY', 'TRY',];
   const quoteCoinsList = ['BTC', 'ETH'];
  
  // export const coinsAlertsList = {
  //   'BTC': {
  //     img: '{{asset('back/img/currencies/1.png')}}',
  //     name: 'Bitcoin',
  //   },
  //   'ETH': {
  //     img: '{{asset('back/img/currencies/1027.png')}}',
  //     name: 'Ethereum',
  //   },
  //   'BNB': {
  //     img: '{{asset('back/img/currencies/1839.png')}}',
  //     name: 'Binance Coin',
  //   },
  //   'ADA': {
  //     img: '{{asset('back/img/currencies/2010.png')}}',
  //     name: 'Cardano',
  //   },
  //   'DOT': {
  //     img: '{{asset('back/img/currencies/coin_12.svg')}}',
  //     name: 'Polkadot',
  //   },
  //   'XRP': {
  //     img: '{{asset('back/img/currencies/coin_35.svg')}}',
  //     name: 'Ripple',
  //   },
  //   'BCH': {
  //     img: '{{asset('back/img/currencies/coin_6.svg')}}',
  //     name: 'Bitcoin cash',
  //   },
  //   'DOGE': {
  //     img: '{{asset('back/img/currencies/coin_11.png')}}',
  //     name: 'Dogecoin',
  //   },
  //   'UNI': {
  //     img: '{{asset('back/img/currencies/3602.png')}}',
  //     name: 'Uniswap',
  //   },
  //   'LTC': {
  //     img: '{{asset('back/img/currencies/coin_22.svg')}}',
  //     name: 'Litecoin',
  //   },
  //   'ABT': {
  //     img: '{{asset('back/img/currencies/coin_2.png')}}',
  //     name: 'ArcBlock',
  //   },
  //   'BAND': {
  //     img: '{{asset('back/img/currencies/coin_4.png')}}',
  //     name: 'BAND',
  //   },
  //   'BAT': {
  //     img: '{{asset('back/img/currencies/coin_5.png')}}',
  //     name: 'BAT',
  //   },
  //   'BSV': {
  //     img: '{{asset('back/img/currencies/3602.png')}}',
  //     name: 'Bitcoin SV',
  //   },
  //   'CVC': {
  //     img: '{{asset('back/img/currencies/coin_9.png')}}',
  //     name: 'Civic',
  //   },
  //   'DAI': {
  //     img: '{{asset('back/img/currencies/coin_10.png')}}',
  //     name: 'Dai',
  //   },
  //   'EVX': {
  //     img: '{{asset('back/img/currencies/coin_14.png')}}',
  //     name: 'Everex',
  //   },
  //   'GLM': {
  //     img: '{{asset('back/img/currencies/coin_15.png')}}',
  //     name: 'Golem',
  //   },
  //   'INF': {
  //     img: '{{asset('back/img/currencies/coin_16.png')}}',
  //     name: 'Infinitus',
  //   },
  //   'IOST': {
  //     img: '{{asset('back/img/currencies/coin_17.png')}}',
  //     name: 'IOST',
  //   },
  //   'JFIN': {
  //     img: '{{asset('back/img/currencies/coin_18.png')}}',
  //     name: 'Jfin',
  //   },
  //   'KNC': {
  //     img: '{{asset('back/img/currencies/coin_19.png')}}',
  //     name: 'Kyber Network Crystals',
  //   },
  //   'KSM': {
  //     img: '{{asset('back/img/currencies/coin_20.png')}}',
  //     name: 'Kusama',
  //   },
  //   'LINK': {
  //     img: '{{asset('back/img/currencies/coin_21.svg')}}',
  //     name: 'Chainlink',
  //   },
  //   'MANA': {
  //     img: '{{asset('back/img/currencies/coin_23.png')}}',
  //     name: 'Mana',
  //   },
  //   'NEAR': {
  //     img: '{{asset('back/img/currencies/coin_24.png')}}',
  //     name: 'NEAR',
  //   },
  //   'OMG': {
  //     img: '{{asset('back/img/currencies/coin_25.png')}}',
  //     name: 'OMG',
  //   },
  //   'POW': {
  //     img: '{{asset('back/img/currencies/coin_26.png')}}',
  //     name: 'POW',
  //   },
  //   'RDN': {
  //     img: '{{asset('back/img/currencies/coin_27.png')}}',
  //     name: 'RDN',
  //   },
  //   'SCRT': {
  //     img: '{{asset('back/img/currencies/coin_28.png')}}',
  //     name: 'Secret Network',
  //   },
  //   'SIX': {
  //     img: '{{asset('back/img/currencies/coin_29.png')}}',
  //     name: 'SIX',
  //   },
  //   'SNT': {
  //     img: '{{asset('back/img/currencies/coin_30.png')}}',
  //     name: 'SNT',
  //   },
  //   'USDC': {
  //     img: '{{asset('back/img/currencies/coin_31.svg')}}',
  //     name: 'USDC',
  //   },
  //   'USDT': {
  //     img: '{{asset('back/img/currencies/coin_32.png')}}',
  //     name: 'USDT',
  //   },
  //   'WAN': {
  //     img: '{{asset('back/img/currencies/coin_33.png')}}',
  //     name: 'Wanchain',
  //   },
  //   'XLM': {
  //     img: '{{asset('back/img/currencies/coin_34.svg')}}',
  //     name: 'Stellar',
  //   },
  //   'ZIL': {
  //     img: '{{asset('back/img/currencies/coin_36.png')}}',
  //     name: 'Zilliqa',
  //   },
  //   'ZRX': {
  //     img: '{{asset('back/img/currencies/coin_37.png')}}',
  //     name: 'ZRX',
  //   },
  //   'default' : {
  //     img: '{{asset('back/img/currencies/coin_23.png')}}',
  //     name: 'NOT FOUND',
  //   }
  // };
  
   const coinsAlertsList = {
      "BTC": {
          "img": "{{asset('back/img/currencies/1.png')}}",
          "name": "Bitcoin"
      },
      "ETH": {
          "img": "{{asset('back/img/currencies/1027.png')}}",
          "name": "Ethereum"
      },
      "BNB": {
          "img": "{{asset('back/img/currencies/1839.png')}}",
          "name": "Binance Coin"
      },
      "XRP": {
          "img": "{{asset('back/img/currencies/52.png')}}",
          "name": "XRP"
      },
      "USDT": {
          "img": "{{asset('back/img/currencies/825.png')}}",
          "name": "Tether"
      },
      "ADA": {
          "img": "{{asset('back/img/currencies/2010.png')}}",
          "name": "Cardano"
      },
      "DOT": {
          "img": "{{asset('back/img/currencies/6636.png')}}",
          "name": "Polkadot"
      },
      "UNI": {
          "img": "{{asset('back/img/currencies/7083.png')}}",
          "name": "Uniswap"
      },
      "LTC": {
          "img": "{{asset('back/img/currencies/2.png')}}",
          "name": "Litecoin"
      },
      "LINK": {
          "img": "{{asset('back/img/currencies/1975.png')}}",
          "name": "Chainlink"
      },
      "DOGE": {
          "img": "{{asset('back/img/currencies/74.png')}}",
          "name": "Dogecoin"
      },
      "BCH": {
          "img": "{{asset('back/img/currencies/1831.png')}}",
          "name": "Bitcoin Cash"
      },
      "XLM": {
          "img": "{{asset('back/img/currencies/512.png')}}",
          "name": "Stellar"
      },
      "THETA": {
          "img": "{{asset('back/img/currencies/2416.png')}}",
          "name": "THETA"
      },
      "VET": {
          "img": "{{asset('back/img/currencies/3077.png')}}",
          "name": "VeChain"
      },
      "FIL": {
          "img": "{{asset('back/img/currencies/2280.png')}}",
          "name": "Filecoin"
      },
      "USDC": {
          "img": "{{asset('back/img/currencies/3408.png')}}",
          "name": "USD Coin"
      },
      "TRX": {
          "img": "{{asset('back/img/currencies/1958.png')}}",
          "name": "TRON"
      },
      "WBTC": {
          "img": "{{asset('back/img/currencies/3717.png')}}",
          "name": "Wrapped Bitcoin"
      },
      "SOL": {
          "img": "{{asset('back/img/currencies/5426.png')}}",
          "name": "Solana"
      },
      "EOS": {
          "img": "{{asset('back/img/currencies/1765.png')}}",
          "name": "EOS"
      },
      "KLAY": {
          "img": "{{asset('back/img/currencies/4256.png')}}",
          "name": "Klaytn"
      },
      "BSV": {
          "img": "{{asset('back/img/currencies/3602.png')}}",
          "name": "Bitcoin SV"
      },
      "LUNA": {
          "img": "{{asset('back/img/currencies/4172.png')}}",
          "name": "Terra"
      },
      "MIOTA": {
          "img": "{{asset('back/img/currencies/1720.png')}}",
          "name": "IOTA"
      },
      "CRO": {
          "img": "{{asset('back/img/currencies/3635.png')}}",
          "name": "Crypto.com Coin"
      },
      "XMR": {
          "img": "{{asset('back/img/currencies/monero.png')}}",
          "name": "Monero"
      },
      "ATOM": {
          "img": "{{asset('back/img/currencies/3794.png')}}",
          "name": "Cosmos"
      },
      "AAVE": {
          "img": "{{asset('back/img/currencies/7278.png')}}",
          "name": "Aave"
      },
      "BUSD": {
          "img": "{{asset('back/img/currencies/4687.png')}}",
          "name": "Binance USD"
      },
      "FTT": {
          "img": "{{asset('back/img/currencies/4195.png')}}",
          "name": "FTX Token"
      },
      "BTT": {
          "img": "{{asset('back/img/currencies/3718.png')}}",
          "name": "BitTorrent"
      },
      "XTZ": {
          "img": "{{asset('back/img/currencies/2011.png')}}",
          "name": "Tezos"
      },
      "AVAX": {
          "img": "{{asset('back/img/currencies/5805.png')}}",
          "name": "Avalanche"
      },
      "NEO": {
          "img": "{{asset('back/img/currencies/1376.png')}}",
          "name": "Neo"
      },
      "ALGO": {
          "img": "{{asset('back/img/currencies/4030.png')}}",
          "name": "Algorand"
      },
      "KSM": {
          "img": "{{asset('back/img/currencies/5034.png')}}",
          "name": "Kusama"
      },
      "EGLD": {
          "img": "{{asset('back/img/currencies/6892.png')}}",
          "name": "Elrond"
      },
      "XEM": {
          "img": "{{asset('back/img/currencies/873.png')}}",
          "name": "NEM"
      },
      "HT": {
          "img": "{{asset('back/img/currencies/2502.png')}}",
          "name": "Huobi Token"
      },
      "RUNE": {
          "img": "{{asset('back/img/currencies/4157.png')}}",
          "name": "THORChain"
      },
      "CAKE": {
          "img": "{{asset('back/img/currencies/7186.png')}}",
          "name": "PancakeSwap"
      },
      "BTCB": {
          "img": "{{asset('back/img/currencies/4023.png')}}",
          "name": "Bitcoin BEP2"
      },
      "DAI": {
          "img": "{{asset('back/img/currencies/4943.png')}}",
          "name": "Dai"
      },
      "HOT": {
          "img": "{{asset('back/img/currencies/2682.png')}}",
          "name": "Holo"
      },
      "DASH": {
          "img": "{{asset('back/img/currencies/131.png')}}",
          "name": "Dash"
      },
      "CHZ": {
          "img": "{{asset('back/img/currencies/4066.png')}}",
          "name": "Chiliz"
      },
      "MKR": {
          "img": "{{asset('back/img/currencies/1518.png')}}",
          "name": "Maker"
      },
      "HBAR": {
          "img": "{{asset('back/img/currencies/4642.png')}}",
          "name": "Hedera Hashgraph"
      },
      "ZEC": {
          "img": "{{asset('back/img/currencies/1437.png')}}",
          "name": "Zcash"
      },
      "STX": {
          "img": "{{asset('back/img/currencies/4847.png')}}",
          "name": "Stacks"
      },
      "COMP": {
          "img": "{{asset('back/img/currencies/5692.png')}}",
          "name": "Compound"
      },
      "DCR": {
          "img": "{{asset('back/img/currencies/1168.png')}}",
          "name": "Decred"
      },
      "ETC": {
          "img": "{{asset('back/img/currencies/1321.png')}}",
          "name": "Ethereum Classic"
      },
      "GRT": {
          "img": "{{asset('back/img/currencies/6719.png')}}",
          "name": "The Graph"
      },
      "ENJ": {
          "img": "{{asset('back/img/currencies/2130.png')}}",
          "name": "Enjin Coin"
      },
      "SNX": {
          "img": "{{asset('back/img/currencies/2586.png')}}",
          "name": "Synthetix"
      },
      "ZIL": {
          "img": "{{asset('back/img/currencies/2469.png')}}",
          "name": "Zilliqa"
      },
      "NEAR": {
          "img": "{{asset('back/img/currencies/6535.png')}}",
          "name": "NEAR Protocol"
      },
      "SUSHI": {
          "img": "{{asset('back/img/currencies/6758.png')}}",
          "name": "SushiSwap"
      },
      "BAT": {
          "img": "{{asset('back/img/currencies/1697.png')}}",
          "name": "Basic Attention Token"
      },
      "LEO": {
          "img": "{{asset('back/img/currencies/3957.png')}}",
          "name": "UNUS SED LEO"
      },
      "MATIC": {
          "img": "{{asset('back/img/currencies/3890.png')}}",
          "name": "Polygon"
      },
      "NEXO": {
          "img": "{{asset('back/img/currencies/2694.png')}}",
          "name": "Nexo"
      },
      "BTG": {
          "img": "{{asset('back/img/currencies/2083.png')}}",
          "name": "Bitcoin Gold"
      },
      "RVN": {
          "img": "{{asset('back/img/currencies/2577.png')}}",
          "name": "Ravencoin"
      },
      'IOST': {
        img: '{{asset('back/img/currencies/coin_17.png')}}',
        name: 'IOST',
      },
  };
  
</script>