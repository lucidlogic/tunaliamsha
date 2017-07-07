@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <p>Welcome to jaro.ai!</p>
                        <p><a href="/get-started">Get started</a> and set up an API key and then you're ready to go.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
