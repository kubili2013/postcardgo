@extends('layouts.base', ['bodyClass' => 'home'])

@section('body')


    <div class="jumbotron text-center">
        <div class="logo"><img src="{{ asset('images/postcardgo.png') }}" title="postcardgo.com"></div>
        <h2>Pay $ 4.99, A Wooden Postcard From China Will Fly To U !</h2>

        <div style="margin-top:40px">
            @if (Auth::guest())
                <a class="btn btn-primary" href="{{ route('register') }}">
                    Join Us
                </a>
                <a class="btn btn-default" href="{{ route('forum') }}">
                    Visit the Forum
                </a>
            @else
                <a class="btn btn-default" href="{{ route('threads.create') }}">
                    Start
                </a>
            @endif
        </div>
    </div>

    <div class="container">
        @include('layouts._alerts')
    </div>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Pay $ 4.99, A Wooden Postcard From China Will Fly To U !</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'paypal.topay', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                {{--<div class="form-group">--}}
                {{--<div class="col-md-6 col-md-offset-3">--}}
                {{--<img class="img-circle" src="{{ Auth::user()->gravatarUrl(100) }}">--}}
                {{--<span class="help-block">Change your avatar on <a href="https://gravatar.com/">Gravatar</a>.</span>--}}
                {{--</div>--}}
                {{--</div>--}}

                @formGroup('country')
                {!! Form::label('country', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('country', "", ['class' => 'form-control country_selector', 'required']) !!}
                    <span class="help-block">Please select your country code.</span>
                    @error('country')
                </div>
                @endFormGroup

                @formGroup('email')
                {!! Form::label('email', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::email('email', Auth::check() ? Auth::user()->emailAddress() : '', ['class' => 'form-control', 'required']) !!}
                    <span class="help-block">Once the postcard is sent,  we will send a notification email to this email address.</span>
                    @error('email')
                </div>
                @endFormGroup

                @formGroup('real_name')
                {!! Form::label('real name', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('real_name', "", ['class' => 'form-control', 'required']) !!}
                    <span class="help-block">Please fill in the name of the Addressee</span>
                    @error('real_name')
                </div>
                @endFormGroup

                @formGroup('address')
                {!! Form::label('address', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('address', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please fill in the address, for example: XXXX</span>
                    @error('address')
                </div>
                @endFormGroup

                @formGroup('postcode')
                {!! Form::label('postcode', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('postcode', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please fill in the zip code.</span>
                    @error('postcode')
                </div>
                @endFormGroup

                @formGroup('message')
                {!! Form::label('message', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::textarea('message', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please fill in the message in 160 characters or less.</span>
                    @error('message')
                </div>
                @endFormGroup
                @formGroup('submit')
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button class="form-control btn btn-danger" type="submit" ><span class="fa fa-paypal"></span>&nbsp;&nbsp;PayPal</button>
                    <div style="width:100%;margin:5px auto; text-align: center;">
                        <img data-button="" data-funding-source="card" data-card="visa" class="paypal-button-card paypal-button-card-visa paypal-button" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMCAxLjkyN0MwIC44NjMuODkyIDAgMS45OTIgMGgzNi4wMTZDMzkuMTA4IDAgNDAgLjg2MyA0MCAxLjkyN3YyMC4xNDZDNDAgMjMuMTM3IDM5LjEwOCAyNCAzOC4wMDggMjRIMS45OTJDLjg5MiAyNCAwIDIzLjEzNyAwIDIyLjA3M1YxLjkyN3oiIHN0eWxlPSJmaWxsOiByZ2IoMzMsIDg2LCAxNTQpOyIvPgogIDxwYXRoIGQ9Ik0xOS41OTYgNy44ODVsLTIuMTEgOS40NzhIMTQuOTNsMi4xMS05LjQ3OGgyLjU1NHptMTAuNzQzIDYuMTJsMS4zNDMtMy41Ni43NzMgMy41NkgzMC4zNHptMi44NSAzLjM1OGgyLjM2bC0yLjA2My05LjQ3OEgzMS4zMWMtLjQ5MiAwLS45MDUuMjc0LTEuMDg4LjY5NWwtMy44MzIgOC43ODNoMi42ODJsLjUzMi0xLjQxNWgzLjI3NmwuMzEgMS40MTV6bS02LjY2Ny0zLjA5NGMuMDEtMi41MDItMy42LTIuNjQtMy41NzctMy43Ni4wMDgtLjMzOC4zNDUtLjcgMS4wODMtLjc5My4zNjUtLjA0NSAxLjM3My0uMDggMi41MTcuNDI1bC40NDgtMi4wMWMtLjYxNS0uMjE0LTEuNDA1LS40Mi0yLjM5LS40Mi0yLjUyMyAwLTQuMyAxLjI4OC00LjMxMyAzLjEzMy0uMDE2IDEuMzY0IDEuMjY4IDIuMTI1IDIuMjM0IDIuNTguOTk2LjQ2NCAxLjMzLjc2MiAxLjMyNSAxLjE3Ny0uMDA2LjYzNi0uNzkzLjkxOC0xLjUyNi45MjgtMS4yODUuMDItMi4wMy0uMzMzLTIuNjIzLS42bC0uNDYyIDIuMDhjLjU5OC4yNjIgMS43LjQ5IDIuODQuNTAyIDIuNjgyIDAgNC40MzctMS4yNzMgNC40NDUtMy4yNDN6TTE1Ljk0OCA3Ljg4NGwtNC4xMzggOS40NzhoLTIuN0w3LjA3NiA5LjhjLS4xMjMtLjQ2Ni0uMjMtLjYzNy0uNjA2LS44MzQtLjYxNS0uMzItMS42My0uNjItMi41Mi0uODA2bC4wNi0uMjc1aDQuMzQ1Yy41NTQgMCAxLjA1Mi4zNTQgMS4xNzguOTY2bDEuMDc2IDUuNDg2IDIuNjU1LTYuNDVoMi42ODN6IiBzdHlsZT0iZmlsbDogcmdiKDI1NSwgMjU1LCAyNTUpOyIvPgo8L3N2Zz4=" alt="visa" style="display: inline-block;">
                        &nbsp;<img data-button="" data-funding-source="card" data-card="mastercard" class="paypal-button-card paypal-button-card-mastercard paypal-button" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMCAxLjkyN0MwIC44NjMuODkyIDAgMS45OTIgMGgzNi4wMTZDMzkuMTA4IDAgNDAgLjg2MyA0MCAxLjkyN3YyMC4xNDZDNDAgMjMuMTM3IDM5LjEwOCAyNCAzOC4wMDggMjRIMS45OTJDLjg5MiAyNCAwIDIzLjEzNyAwIDIyLjA3M1YxLjkyN3oiIHN0eWxlPSJmaWxsOiByZ2IoNjIsIDU3LCA1Nyk7Ii8+CiAgPHBhdGggc3R5bGU9ImZpbGw6IHJnYigyNTUsIDk1LCAwKTsiIGQ9Ik0gMjIuMjA1IDMuOTAxIEwgMTUuNjg4IDMuOTAxIEwgMTUuNjg4IDE1LjU4OSBMIDIyLjIwNSAxNS41ODkiLz4KICA8cGF0aCBkPSJNIDE2LjEgOS43NDcgQyAxNi4xIDcuMzcxIDE3LjIxOCA1LjI2NSAxOC45MzUgMy45MDEgQyAxNy42NyAyLjkxMiAxNi4wNzggMi4zMTIgMTQuMzQyIDIuMzEyIEMgMTAuMjIzIDIuMzEyIDYuODkyIDUuNjM2IDYuODkyIDkuNzQ2IEMgNi44OTIgMTMuODUzIDEwLjIyMyAxNy4xNzggMTQuMzQyIDE3LjE3OCBDIDE2LjA3OCAxNy4xNzggMTcuNjcgMTYuNTggMTguOTM1IDE1LjU4OCBDIDE3LjIxNiAxNC4yNDYgMTYuMDk5IDEyLjExOSAxNi4wOTkgOS43NDUgWiIgc3R5bGU9ImZpbGw6IHJnYigyMzUsIDAsIDI3KTsiLz4KICA8cGF0aCBkPSJNIDMwLjk5NiA5Ljc0NyBDIDMwLjk5NiAxMy44NTQgMjcuNjYzIDE3LjE3OSAyMy41NDcgMTcuMTc5IEMgMjEuODEgMTcuMTc5IDIwLjIxNiAxNi41ODEgMTguOTU0IDE1LjU4OSBDIDIwLjY5MSAxNC4yMjcgMjEuNzg4IDEyLjEyIDIxLjc4OCA5Ljc0NiBDIDIxLjc4OCA3LjM3IDIwLjY3MSA1LjI2NCAxOC45NTQgMy45IEMgMjAuMjE2IDIuOTExIDIxLjgxIDIuMzExIDIzLjU0NyAyLjMxMSBDIDI3LjY2MyAyLjMxMSAzMC45OTYgNS42NTcgMzAuOTk2IDkuNzQ1IFoiIHN0eWxlPSJmaWxsOiByZ2IoMjQ3LCAxNTgsIDI3KTsiLz4KICA8cGF0aCBkPSJNIDcuMTY3IDIyLjQ4MSBMIDcuMTY3IDIwLjQzIEMgNy4xNjcgMTkuNjQxIDYuNjg1IDE5LjEyNyA1Ljg1NyAxOS4xMjcgQyA1LjQ0MyAxOS4xMjcgNC45OTMgMTkuMjYyIDQuNjgzIDE5LjcxIEMgNC40NCAxOS4zMzIgNC4wOTYgMTkuMTI3IDMuNTc5IDE5LjEyNyBDIDMuMjMzIDE5LjEyNyAyLjg4OCAxOS4yMyAyLjYxMiAxOS42MDcgTCAyLjYxMiAxOS4xOTcgTCAxLjg4NiAxOS4xOTcgTCAxLjg4NiAyMi40ODEgTCAyLjYxMiAyMi40ODEgTCAyLjYxMiAyMC42NjggQyAyLjYxMiAyMC4wODYgMi45MjEgMTkuODEyIDMuNDA2IDE5LjgxMiBDIDMuODg4IDE5LjgxMiA0LjEzMSAyMC4xMjEgNC4xMzEgMjAuNjY5IEwgNC4xMzEgMjIuNDgxIEwgNC44NTYgMjIuNDgxIEwgNC44NTYgMjAuNjY4IEMgNC44NTYgMjAuMDg2IDUuMjA0IDE5LjgxMiA1LjY1MSAxOS44MTIgQyA2LjEzNyAxOS44MTIgNi4zNzcgMjAuMTIxIDYuMzc3IDIwLjY2OSBMIDYuMzc3IDIyLjQ4MSBMIDcuMTcxIDIyLjQ4MSBaIE0gMTcuOTA5IDE5LjE5NyBMIDE2LjczNCAxOS4xOTcgTCAxNi43MzQgMTguMjA0IEwgMTYuMDA3IDE4LjIwNCBMIDE2LjAwNyAxOS4xOTcgTCAxNS4zNTIgMTkuMTk3IEwgMTUuMzUyIDE5Ljg0NSBMIDE2LjAwNyAxOS44NDUgTCAxNi4wMDcgMjEuMzUxIEMgMTYuMDA3IDIyLjEwNiAxNi4zMTkgMjIuNTUxIDE3LjE0NiAyMi41NTEgQyAxNy40NTkgMjIuNTUxIDE3LjgwNCAyMi40NDkgMTguMDQ0IDIyLjMwOSBMIDE3LjgzOSAyMS42OTUgQyAxNy42MzIgMjEuODMxIDE3LjM4OSAyMS44NjcgMTcuMjE2IDIxLjg2NyBDIDE2Ljg3MiAyMS44NjcgMTYuNzM0IDIxLjY2IDE2LjczNCAyMS4zMTkgTCAxNi43MzQgMTkuODQ3IEwgMTcuOTA5IDE5Ljg0NyBMIDE3LjkwOSAxOS4xOTggWiBNIDI0LjA1MyAxOS4xMjcgQyAyMy42MzkgMTkuMTI3IDIzLjM2NCAxOS4zMzIgMjMuMTkxIDE5LjYwNyBMIDIzLjE5MSAxOS4xOTcgTCAyMi40NjUgMTkuMTk3IEwgMjIuNDY1IDIyLjQ4MSBMIDIzLjE5MSAyMi40ODEgTCAyMy4xOTEgMjAuNjMzIEMgMjMuMTkxIDIwLjA4NiAyMy40MzQgMTkuNzc3IDIzLjg4MiAxOS43NzcgQyAyNC4wMTggMTkuNzc3IDI0LjE5MiAxOS44MTIgMjQuMzMgMTkuODQ3IEwgMjQuNTM4IDE5LjE2MiBDIDI0LjQwMSAxOS4xMjcgMjQuMTkyIDE5LjEyNyAyNC4wNTIgMTkuMTI3IFogTSAxNC43NjUgMTkuNDY5IEMgMTQuNDIgMTkuMjI5IDEzLjkzNyAxOS4xMjcgMTMuNDE4IDE5LjEyNyBDIDEyLjU4OCAxOS4xMjcgMTIuMDM2IDE5LjUzOCAxMi4wMzYgMjAuMTg4IEMgMTIuMDM2IDIwLjczNiAxMi40NTMgMjEuMDQ0IDEzLjE3NSAyMS4xNDYgTCAxMy41MjQgMjEuMTgxIEMgMTMuOTAzIDIxLjI0OSAxNC4xMDggMjEuMzUxIDE0LjEwOCAyMS41MjMgQyAxNC4xMDggMjEuNzY1IDEzLjgzMiAyMS45MzQgMTMuMzUgMjEuOTM0IEMgMTIuODY0IDIxLjkzNCAxMi40ODQgMjEuNzY0IDEyLjI0NCAyMS41OTIgTCAxMS44OTggMjIuMTM5IEMgMTIuMjc4IDIyLjQxMSAxMi43OTQgMjIuNTQ5IDEzLjMxMyAyMi41NDkgQyAxNC4yOCAyMi41NDkgMTQuODMxIDIyLjEwNSAxNC44MzEgMjEuNDg4IEMgMTQuODMxIDIwLjkwOCAxNC4zODMgMjAuNTk5IDEzLjY5MiAyMC40OTYgTCAxMy4zNDggMjAuNDYyIEMgMTMuMDM3IDIwLjQyOCAxMi43OTUgMjAuMzYgMTIuNzk1IDIwLjE1NSBDIDEyLjc5NSAxOS45MTQgMTMuMDM4IDE5Ljc3NyAxMy40MTggMTkuNzc3IEMgMTMuODMgMTkuNzc3IDE0LjI0NSAxOS45NDkgMTQuNDUzIDIwLjA1MiBMIDE0Ljc2NCAxOS40NjkgWiBNIDM0LjAzMyAxOS4xMjcgQyAzMy42MTggMTkuMTI3IDMzLjM0MiAxOS4zMzIgMzMuMTcxIDE5LjYwNyBMIDMzLjE3MSAxOS4xOTcgTCAzMi40NDUgMTkuMTk3IEwgMzIuNDQ1IDIyLjQ4MSBMIDMzLjE3MSAyMi40ODEgTCAzMy4xNzEgMjAuNjMzIEMgMzMuMTcxIDIwLjA4NiAzMy40MTQgMTkuNzc3IDMzLjg2MiAxOS43NzcgQyAzMy45OTggMTkuNzc3IDM0LjE3IDE5LjgxMiAzNC4zMDcgMTkuODQ3IEwgMzQuNTE1IDE5LjE2MiBDIDM0LjM4IDE5LjEyNyAzNC4xNzIgMTkuMTI3IDM0LjAzMyAxOS4xMjcgWiBNIDI0Ljc3OSAyMC44MzggQyAyNC43NzkgMjEuODM0IDI1LjQ3IDIyLjU1MSAyNi41NCAyMi41NTEgQyAyNy4wMjUgMjIuNTUxIDI3LjM2OSAyMi40NDkgMjcuNzE1IDIyLjE3MyBMIDI3LjM2OSAyMS41OTMgQyAyNy4wOTIgMjEuNzk4IDI2LjgxNiAyMS45MDEgMjYuNTA0IDIxLjkwMSBDIDI1LjkxOSAyMS45MDEgMjUuNTA1IDIxLjQ5IDI1LjUwNSAyMC44NCBDIDI1LjUwNSAyMC4yMjYgMjUuOTE5IDE5LjgxMyAyNi41MDcgMTkuNzggQyAyNi44MTYgMTkuNzggMjcuMDkyIDE5Ljg4MyAyNy4zNjkgMjAuMDg5IEwgMjcuNzE1IDE5LjUwNyBDIDI3LjM2OSAxOS4yMzMgMjcuMDI0IDE5LjEzIDI2LjU0IDE5LjEzIEMgMjUuNDcgMTkuMTMgMjQuNzc5IDE5Ljg1IDI0Ljc3OSAyMC44NDEgWiBNIDMxLjQ3OCAyMC44MzggTCAzMS40NzggMTkuMTk4IEwgMzAuNzUgMTkuMTk4IEwgMzAuNzUgMTkuNjA4IEMgMzAuNTEgMTkuMyAzMC4xNjUgMTkuMTI4IDI5LjcxNyAxOS4xMjggQyAyOC43ODQgMTkuMTI4IDI4LjA1OCAxOS44NDggMjguMDU4IDIwLjg0IEMgMjguMDU4IDIxLjgzNSAyOC43ODQgMjIuNTUyIDI5LjcxNiAyMi41NTIgQyAzMC4xOTcgMjIuNTUyIDMwLjU0MyAyMi4zODIgMzAuNzQ4IDIyLjA3NCBMIDMwLjc0OCAyMi40ODQgTCAzMS40NzcgMjIuNDg0IEwgMzEuNDc3IDIwLjg0IFogTSAyOC44MTggMjAuODM4IEMgMjguODE4IDIwLjI1OSAyOS4xOTYgMTkuNzc5IDI5LjgxOSAxOS43NzkgQyAzMC40MDYgMTkuNzc5IDMwLjgyMSAyMC4yMjQgMzAuODIxIDIwLjg0IEMgMzAuODIxIDIxLjQyNCAzMC40MDYgMjEuOTAyIDI5LjgxOSAyMS45MDIgQyAyOS4xOTYgMjEuODY5IDI4LjgxOCAyMS40MjQgMjguODE4IDIwLjg0MSBaIE0gMjAuMTQ4IDE5LjEyOCBDIDE5LjE4MyAxOS4xMjggMTguNDk0IDE5LjgxMyAxOC40OTQgMjAuODQgQyAxOC40OTQgMjEuODY5IDE5LjE4MyAyMi41NTIgMjAuMTg1IDIyLjU1MiBDIDIwLjY3MSAyMi41NTIgMjEuMTU0IDIyLjQxNyAyMS41MzMgMjIuMTA4IEwgMjEuMTg4IDIxLjU5NSBDIDIwLjkxNCAyMS43OTkgMjAuNTY1IDIxLjkzNyAyMC4yMjIgMjEuOTM3IEMgMTkuNzcyIDIxLjkzNyAxOS4zMjMgMjEuNzMyIDE5LjIxOSAyMS4xNDkgTCAyMS42NzEgMjEuMTQ5IEwgMjEuNjcxIDIwLjg3OCBDIDIxLjcwNSAxOS44MTUgMjEuMDgzIDE5LjEzIDIwLjE1IDE5LjEzIFogTSAyMC4xNDggMTkuNzQ4IEMgMjAuNiAxOS43NDggMjAuOTExIDIwLjAxOSAyMC45OCAyMC41MzIgTCAxOS4yNTMgMjAuNTMyIEMgMTkuMzIxIDIwLjA4NyAxOS42MzMgMTkuNzQ4IDIwLjE0OCAxOS43NDggWiBNIDM4LjE0MSAyMC44NCBMIDM4LjE0MSAxNy44OTggTCAzNy40MTIgMTcuODk4IEwgMzcuNDEyIDE5LjYxIEMgMzcuMTczIDE5LjMwMiAzNi44MjggMTkuMTMgMzYuMzggMTkuMTMgQyAzNS40NDYgMTkuMTMgMzQuNzIxIDE5Ljg1IDM0LjcyMSAyMC44NDEgQyAzNC43MjEgMjEuODM3IDM1LjQ0NiAyMi41NTQgMzYuMzc5IDIyLjU1NCBDIDM2Ljg2MSAyMi41NTQgMzcuMjA2IDIyLjM4MyAzNy40MSAyMi4wNzYgTCAzNy40MSAyMi40ODYgTCAzOC4xNCAyMi40ODYgTCAzOC4xNCAyMC44NDEgWiBNIDM1LjQ4MSAyMC44NCBDIDM1LjQ4MSAyMC4yNjEgMzUuODYxIDE5Ljc4IDM2LjQ4NCAxOS43OCBDIDM3LjA2OSAxOS43OCAzNy40ODYgMjAuMjI2IDM3LjQ4NiAyMC44NDEgQyAzNy40ODYgMjEuNDI2IDM3LjA2OSAyMS45MDQgMzYuNDg0IDIxLjkwNCBDIDM1Ljg2MSAyMS44NyAzNS40ODEgMjEuNDI2IDM1LjQ4MSAyMC44NDMgWiBNIDExLjIzNyAyMC44NCBMIDExLjIzNyAxOS4yIEwgMTAuNTE1IDE5LjIgTCAxMC41MTUgMTkuNjEgQyAxMC4yNzIgMTkuMzAyIDkuOTI4IDE5LjEzIDkuNDc4IDE5LjEzIEMgOC41NDUgMTkuMTMgNy44MiAxOS44NSA3LjgyIDIwLjg0MSBDIDcuODIgMjEuODM3IDguNTQ1IDIyLjU1NCA5LjQ3NyAyMi41NTQgQyA5Ljk2IDIyLjU1NCAxMC4zMDQgMjIuMzgzIDEwLjUxMiAyMi4wNzYgTCAxMC41MTIgMjIuNDg2IEwgMTEuMjM2IDIyLjQ4NiBMIDExLjIzNiAyMC44NDEgWiBNIDguNTQ2IDIwLjg0IEMgOC41NDYgMjAuMjYxIDguOTI2IDE5Ljc4IDkuNTQ4IDE5Ljc4IEMgMTAuMTM0IDE5Ljc4IDEwLjU1IDIwLjIyNiAxMC41NSAyMC44NDEgQyAxMC41NSAyMS40MjYgMTAuMTM0IDIxLjkwNCA5LjU0OCAyMS45MDQgQyA4LjkyNiAyMS44NyA4LjU0NiAyMS40MjYgOC41NDYgMjAuODQzIFoiIHN0eWxlPSJmaWxsOiByZ2IoMjU1LCAyNTUsIDI1NSk7Ii8+Cjwvc3ZnPg==" alt="mastercard" style="display: inline-block;">
                        &nbsp;<img data-button="" data-funding-source="card" data-card="amex" class="paypal-button-card paypal-button-card-amex paypal-button" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMzguMzMzIDI0SDEuNjY3Qy43NSAyNCAwIDIzLjI4IDAgMjIuNFYxLjZDMCAuNzIuNzUgMCAxLjY2NyAwaDM2LjY2NkMzOS4yNSAwIDQwIC43MiA0MCAxLjZ2MjAuOGMwIC44OC0uNzUgMS42LTEuNjY3IDEuNnoiIHN0eWxlPSJmaWxsOiByZ2IoMjAsIDExOSwgMTkwKTsiLz4KICA8cGF0aCBkPSJNNi4yNiAxMi4zMmgyLjMxM0w3LjQxNSA5LjY2TTI3LjM1MyA5Ljk3N2gtMy43Mzh2MS4yM2gzLjY2NnYxLjM4NGgtMy42NzV2MS4zODVoMy44MjF2MS4wMDVjLjYyMy0uNzcgMS4zMy0xLjQ2NiAyLjAyNS0yLjIzNWwuNzA3LS43N2MtLjkzNC0xLjAwNC0xLjg3LTIuMDgtMi44MDQtMy4wNzV2MS4wNzd6IiBzdHlsZT0iZmlsbDogcmdiKDI1NSwgMjU1LCAyNTUpOyIvPgogIDxwYXRoIGQ9Ik0zOC4yNSA3aC01LjYwNWwtMS4zMjggMS40TDMwLjA3MiA3SDE2Ljk4NGwtMS4wMTcgMi40MTZMMTQuODc3IDdoLTkuNThMMS4yNSAxNi41aDQuODI2bC42MjMtMS41NTZoMS40bC42MjMgMS41NTZIMjkuOTlsMS4zMjctMS40ODMgMS4zMjggMS40ODNoNS42MDVsLTQuMzYtNC42NjdMMzguMjUgN3ptLTE3LjY4NSA4LjFoLTEuNTU3VjkuODgzTDE2LjY3MyAxNS4xaC0xLjMzTDEzLjAxIDkuODgzbC0uMDg0IDUuMjE3SDkuNzNsLS42MjMtMS41NTZoLTMuMjdMNS4xMzIgMTUuMUgzLjQybDIuODg0LTYuNzcyaDIuNDJsMi42NDUgNi4yMzNWOC4zM2gyLjY0NmwyLjEwNyA0LjUxIDEuODY4LTQuNTFoMi41NzVWMTUuMXptMTQuNzI3IDBoLTIuMDI0bC0yLjAyNC0yLjI2LTIuMDIzIDIuMjZIMjIuMDZWOC4zMjhIMjkuNTNsMS43OTUgMi4xNzcgMi4wMjQtMi4xNzdoMi4wMjVMMzIuMjYgMTEuNzVsMy4wMzIgMy4zNXoiIHN0eWxlPSJmaWxsOiByZ2IoMjU1LCAyNTUsIDI1NSk7Ii8+Cjwvc3ZnPg==" alt="amex" style="display: inline-block;"></div>
                    </div>
                @endFormGroup
                {!! Form::close() !!}
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="{{ asset('plugins/country-select/css/countrySelect.css') }}" rel="stylesheet">
<style>
    .country-select{
        width:100%;
    }
</style>
@endpush
@push('bottom_script')
<script src="{{ asset('plugins/country-select/js/countrySelect.min.js') }}"></script>
<script type="text/javascript">
    $(".country_selector").countrySelect({
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
@endpush
