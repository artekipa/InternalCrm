<tr data-index="{{ $index }}">
    <td>{!! Form::text('nominateds['.$index.'][matrialtype]', old('nominateds['.$index.'][matrialtype]', isset($field) ? $field->matrialtype: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('nominateds['.$index.'][materialloc]', old('nominateds['.$index.'][materialloc]', isset($field) ? $field->materialloc: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('nominateds['.$index.'][sitenumber]', old('nominateds['.$index.'][sitenumber]', isset($field) ? $field->sitenumber: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('nominateds['.$index.'][contactperson]', old('nominateds['.$index.'][contactperson]', isset($field) ? $field->contactperson: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::email('nominateds['.$index.'][cpemail]', old('nominateds['.$index.'][cpemail]', isset($field) ? $field->cpemail: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('nominateds['.$index.'][cpphone]', old('nominateds['.$index.'][cpphone]', isset($field) ? $field->cpphone: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('nominateds['.$index.'][presentation_name]', old('nominateds['.$index.'][presentation_name]', isset($field) ? $field->presentation_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('nominateds['.$index.'][presentation_site_no]', old('nominateds['.$index.'][presentation_site_no]', isset($field) ? $field->presentation_site_no: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('nominateds['.$index.'][eventpersonno]', old('nominateds['.$index.'][eventpersonno]', isset($field) ? $field->eventpersonno: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('nominateds['.$index.'][event_person]', old('nominateds['.$index.'][event_person]', isset($field) ? $field->event_person: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>