@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Getting Started</div>

                    <div class="panel-body">
                        <h4>1) Set up api token</h4>
                        <p>Go to your <a href="/settings#/api">settings</a> and create an api token</p>
                        <img src="/img/api_key.png" class="thumbnail" width="500px">
                        <h4>2) Post to our API</h4>
                        <p>Post your listuing details and image to https://jaro.ai/api/reports</p>
                        <p>Be sure to include, text, category, image(if available) & price</p>
                        <h4>3) Get a response</h4>
                        <p>Our clever machines will analyse your listing and give you back a reponse</p>
                        <h4>4) Profit</h4>
                        <p>Our suggestions are continally learning and improiving, and will improve your conversions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
