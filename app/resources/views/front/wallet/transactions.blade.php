@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<section id="wallet-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 xs-content visible-xs col-sm-12 col-12">
                <ul>
                    <li class="active"><a href="#">P2P Wallet</a>
                    </li>
                    <li><a href="#">Fiat Wallet</a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/icon-13.png" alt="" />
                        </a>
                    </li>
                </ul>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h6>Fiat and Spot balance</h6>
                            <h2>0.00000000 <span>BTC</span></h2>
                            <h5>≈ $0.000000</h5>
                        </div>
                        <div class="col-6">
                            <h6>Fiat and Spot balance</h6>
                            <h2>0.00000000 <span>BTC</span></h2>
                            <h5>≈ $0.000000</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 hidden-xs col-sm-12 col-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <h3>P2P Wallet <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide Balance</a></h3>
                        </div>
                        <div class="col-lg-6 text-right col-sm-6 col-6">	<a href="#" class="btn-primary">Buy</a>
                            <a href="#" class="btn-success">Deposit</a>
                            <a class="mobile-tag" href="#">
                                <img src="img/icon-13.png" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 hidden-xs col-sm-12 col-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-6">
                            <h6>P2P balance</h6>
                            <h2>0.00000000 <span>BTC</span></h2>
                            <h5>≈ $0.000000</h5>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-6">
                            <h6>Fiat balance</h6>
                            <h2>0.00000000 <span>BTC</span></h2>
                            <h5>≈ $0.000000</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 hidden-xs col-sm-12 col-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-5 col-sm-5 col-12">
                            <input type="Search" placeholder="Search Coin" />
                        </div>
                        <div class="col-lg-4 col-sm-4 col-6">
                            <label>
                                <input type="checkbox" />Hide Small Balances</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-12 xs-flush col-sm-12 col-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Coin <i class="fa fa-sort" aria-hidden="true"></i>
                                        </th>
                                        <th>Total <i class="fa fa-sort" aria-hidden="true"></i>
                                        </th>
                                        <th>Available <i class="fa fa-sort" aria-hidden="true"></i>
                                        </th>
                                        <th>Action <i class="fa fa-sort" aria-hidden="true"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="img/bitcoin.png" alt="" />
                                            <label>BTC
                                                <br><span>Bitcoin</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/icon-5.png" alt="" />
                                            <label>ETH
                                                <br><span>Ethereum</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/icon-6.png" alt="" />
                                            <label>BNB
                                                <br><span>BNB</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/icon-7.png" alt="" />
                                            <label>BUSD
                                                <br><span>BNB</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/bitcoin.png" alt="" />
                                            <label>BTC
                                                <br><span>Bitcoin</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/icon-5.png" alt="" />
                                            <label>ETH
                                                <br><span>Ethereum</span>
                                            </label>
                                        </td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>	<a href="#" class="btn-success">Deposit</a>
                                            <a href="#" class="btn-primary">P2P Trading</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">	<span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                    <li class="active"><a href="#">1</a>
                                    </li>
                                    <li><a href="#">2</a>
                                    </li>
                                    <li><a href="#">3</a>
                                    </li>
                                    <li><a href="#">...</a>
                                    </li>
                                    <li><a href="#">24</a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="Next">	<span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center visible-xs col-sm-12 col-12">	<a href="#" class="load-more">Load More</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection