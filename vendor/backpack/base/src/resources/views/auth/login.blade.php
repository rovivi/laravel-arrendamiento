@extends('backpack::layout_guest')

@section('content')


<style> 
       
       .coolbg{
        background:  url("/images/bg1.png");
       }
       .paper {
        background:  #fff;
  box-shadow:
    /* The top layer shadow */
    0 1px 1px rgba(0,0,0,0.15),
    /* The second layer */
    0 10px 0 -5px #eee,
    /* The second layer shadow */
    0 10px 1px -4px rgba(0,0,0,0.15),
     /* The third layer */
    0 20px 0 -10px #eee,
    /* The third layer shadow */
    0 20px 1px -9px rgba(0,0,0,0.15);
    /* Padding for demo purposes */
    padding: 30px;
}
    section{ background:  url("/images/ceconexpo.jpg");
    -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      width: 100%;      
      }
    
    form,h3,{
        background: rgba(1, 1, 1, 0.4);
    }
    .content-wrapper,body{
        background: transparent;
    }
    .box{
        height: 1010%;
    }
    </style>
    
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4 paper"  style=" background:  url('/images/bg1.png')" >
            <h3 class="text-center m-b-20">{{ trans('backpack::base.login') }}</h3>
            <div class="box ">
                <div class="box-body paper ">
                    <form class=" col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has($username) ? ' has-error' : '' }}">
                            <label class="control-label">{{ config('backpack.base.authentication_column_name') }}</label>

                            <div>
                                <input type="text" class="form-control" name="{{ $username }}" value="{{ old($username) }}">

                                @if ($errors->has($username))
                                    <span class="help-block">
                                        <strong>{{ $errors->first($username) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('backpack::base.password') }}</label>

                            <div>
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('backpack::base.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('backpack::base.login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br>            
        </div>

    </div>
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
@endsection
