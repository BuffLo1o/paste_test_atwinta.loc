@extends('layouts.app')

@section('content')
<div style="padding: 0 20px">
  <!-- psates pagination -->
      <div class="panel panel-default">
          <div class="panel-heading">
              Мои записи
          </div>

          <div class="panel-body">
 
              <table class="table table-striped task-table">
                  <thead>
                    <td>Название</td>
                    <td>Дата</td>
                  </thead>
                  <tbody>
  @if (count($pastes) > 0)
                     @foreach ($pastes as $paste)
                          <tr>
                              <td class="table-text">
                                  <a href="{{ url('/' . $paste->link)}}"><div>{{ trim($paste->name)==''?'Без названия':$paste->name }}</div></a>
                              </td>
                              <td class="table-text">
                                  {{ $paste->created_at }}
                              </td>
                          </tr>
                      @endforeach
  @endif            
                  </tbody>
              </table>
@if($pastes!=null)              
{{ $pastes->links() }}
@endif
          </div>
      </div>
</div>
@endsection
