@if($template_tasks && $template_tasks->count())
  @foreach ($template_tasks as $template_task)
  <tr>
    <td>
      {!! Form::hidden('template_tasks_mappings_id[]', $template_task->id) !!}
      {!! Form::number('task_sequence[]', $template_task->task_sequence ?? null, ['class' => 'form-control', 'placeholder' => 'SL', 'required']) !!}
      <span class="error-msg task_sequence"></span>
    </td>
    <td>
      {!! Form::text('task_name[]', $template_task->task->name ?? null, ['class' => 'form-control', 'placeholder' => 'Task Name', 'required']) !!}
      <span class="error-msg task_name"></span>
    </td>
    <td>
      {!! Form::text('task_short_name[]', $template_task->task->short_name ?? null, ['class' => 'form-control', 'placeholder' => 'Task Short Name']) !!}
      <span class="error-msg task_short_name"></span>
    </td>
    <td>
      {!! Form::textarea('task_description[]', $template_task->task->description ?? null, ['class' => 'form-control', 'rows' => '1', 'placeholder' => 'Task Description']) !!}
      <span class="error-msg task_description"></span>
    </td>
    <td>
      {!! Form::number('task_completion_time[]', $template_task->task_completion_time ?? null, ['class' => 'form-control', 'placeholder' => 'Write Number']) !!}
      <span class="error-msg task_completion_time"></span>
    </td>
    <td>
      {!! Form::select('active_status[]', ACTIVE_STATUS_OPTIONS, $template_task->active_status ?? ACTIVE_STATUS_OPTIONS[0], ['class' => 'form-control', 'placeholder' => 'Write Number']) !!}
      <span class="error-msg active_status"></span>
    </td>
    <td>
      <div>
        <button type="button" class="btn btn-sm btn-outline-light add-item">
          <i class="bx bx-plus-circle"></i>
        </button>
        <button type="button" class="btn btn-sm btn-outline-danger remove-item {{ $template_tasks->count() <= 1 ? 'd-none': '' }}" >
          <i class="bx bx-minus-circle"></i>
        </button>
      </div>
    </td>
  </tr>
  @endforeach
@else
<tr>
  <td>
    {!! Form::hidden('template_tasks_mappings_id[]', null) !!}
    {!! Form::number('task_sequence[]', null, ['class' => 'form-control', 'placeholder' => 'SL', 'required']) !!}
    <span class="error-msg task_sequence"></span>
  </td>
  <td>
    {!! Form::text('task_name[]', null, ['class' => 'form-control', 'placeholder' => 'Task Name', 'required']) !!}
    <span class="error-msg task_name"></span>
  </td>
  <td>
    {!! Form::text('task_short_name[]', null, ['class' => 'form-control', 'placeholder' => 'Task Short Name']) !!}
    <span class="error-msg task_short_name"></span>
  </td>
  <td>
    {!! Form::textarea('task_description[]', null, ['class' => 'form-control', 'rows' => '1', 'placeholder' => 'Task Description']) !!}
    <span class="error-msg task_description"></span>
  </td>
  <td>
    {!! Form::number('task_completion_time[]', null, ['class' => 'form-control', 'placeholder' => 'Write Number']) !!}
    <span class="error-msg task_completion_time"></span>
  </td>
  <td>
    {!! Form::select('active_status[]', ACTIVE_STATUS_OPTIONS, ACTIVE_STATUS_OPTIONS[0], ['class' => 'form-control']) !!}
    <span class="error-msg active_status"></span>
  </td>
  <td>
    <div>
      <button type="button" class="btn btn-sm btn-outline-light add-item">
        <i class="bx bx-plus-circle"></i>
      </button>
      <button type="button" class="btn btn-sm btn-outline-danger d-none remove-item">
        <i class="bx bx-minus-circle"></i>
      </button>
    </div>
  </td>
</tr>
@endif