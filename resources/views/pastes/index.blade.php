@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Новый код
                </div>
                
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New paste Form -->
                    <form action="{{ url('paste') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group" style="padding: 0 20px">
                            <label for="paste-text" class="col-sm-3 ">Текст</label>

                                <textarea name="text" id="paste-text" class="form-control" rows="15">{{ old('paste') }}</textarea>
                        </div>
                        
                        <!-- paste exp time -->
                        <div class="form-group">
                            <label for="paste-exp_time" class="col-sm-3 control-label">Время жизни</label>

                            <div class="col-sm-6">
                                <select name="exp_time" id="paste-exp_time" class="form-control">
                                    <option value="10">10 мин</option>
                                    <option value="60">1 час</option>
                                    <option value="180">3 часа</option>
                                    <option value="1440">1 день</option>                                    
                                    <option value="10080">1 неделя</option>
                                    <option value="44640">1 месяц</option>
                                    <option value="1000000000">Не ограничено</option>
                                </select>
                            </div>
                        </div>                            
                        <!-- paste access -->
                        <div class="form-group">
                            <label for="paste-access" class="col-sm-3 control-label">Доступ</label>

                            <div class="col-sm-6">
                                <select name="access" id="paste-access" class="form-control">
                                    <option value="0">Публичный</option>
                                    <option value="1">По ссылке</option>
                                    
                                    <option value="2" @if (Auth::user()==null) 
                                            disabled 
                                            @endif
                                            >Приватный (только себе)</option>
                                    
                                </select>
                            </div>
                        </div>                          
                        <!-- paste lang -->
                        <div class="form-group">
                            <label for="paste-lang" class="col-sm-3 control-label">Язык</label>

                            <div class="col-sm-6">
                                <select name="lang" id="paste-lang" class="form-control">
                                    <option value="">Не выбран</option>
                                    <option value="php">PHP</option>
                                    <option value="js">JavaScript</option>
                                    <option value="css">CSS</option>
                                    <option value="sql">SQL</option>                                    
                                    <option value="csharp">C#</option>
                                    <option value="cpp">C++</option>
                                    <option value="delphi">Delphi</option>
                                    <option value="java">Java</option>
                                    <option value="xml">XML</option>       
                                    <option value="vb">Visual Basic</option>  
                                    <option value="py">Python</option>     
                                    <option value="perl">Perl</option>                                    
                                    <option value="as3">ActionScript3</option>
                                    <option value="bash">Bash/shell</option>
                                    <option value="cf">ColdFusion</option>
                                    <option value="diff">Diff</option>
                                    <option value="erl">Erlang</option>
                                    <option value="groovy">Groovy</option>
                                    <option value="jfx">JavaFX</option>
                                    <option value="plain">Plain Text</option>
                                    <option value="ps">PowerShell</option>
                                    <option value="ruby">Ruby</option>
                                    <option value="scala">Scala</option>
                                </select>
                            </div>
                        </div>                        
                        
                        <!-- paste Name -->
                        <div class="form-group">
                            <label for="paste-name" class="col-sm-3 control-label">Название</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="paste-name" class="form-control" value="{{ old('paste') }}">
                            </div>
                        </div>

                        <!-- Add paste Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Добавить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
