@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
            @if ($paste!=null)
            @if($paste->access<2 || ($paste->access==2 && Auth::user()!=null && $paste->user_id==Auth::user()->id))
                @if ($paste->date_diff<=0)
                <div class="panel-heading">
                    Название: {{ $paste->name }} от {{ $paste->created_at }}
                </div>
                <div class="panel-heading">
                    Ссылка: <a href="{{ url('/' . $paste->link)}}">{{ url('/' . $paste->link)}}</a> 
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    Текст: 
                    <script type="text/javascript" src="{!! asset('sh/scripts/shCore.js') !!}"></script>
                    @if ($paste->lang!='')
                    <script type="text/javascript" src="{!! asset('sh/scripts/shBrush_'.$paste->lang.'.js') !!}"></script>
                    @endif
                    <script type="text/javascript">
                    
                        SyntaxHighlighter.all();
                    </script>
                    <div>
                        <pre class="brush: {{ $paste->lang }}">{!! $paste->text !!}</pre>
                    
                    </div>
                    
                </div>
                @else
                <div class="panel-heading">
                    Ссылки не существует или время копии закончилось
                </div>                
                @endif
                @else
                <div class="panel-heading">
                    Ссылки не существует или время копии закончилось
                </div>    
            @endif
            @endif
            </div>
            <a onclick="history.back()">Назад</a>
       </div>
    </div>
@endsection
