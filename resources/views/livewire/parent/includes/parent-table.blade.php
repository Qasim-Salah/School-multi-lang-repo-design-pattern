<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="show_form_add"
        type="button">{{ __('parent-trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>{{ __('parent-trans.email') }}</th>
            <th>{{ __('parent-trans.name_father') }}</th>
            <th>{{ __('parent-trans.phone_father') }}</th>
            <th>{{ __('parent-trans.job_father') }}</th>
            <th>{{ __('parent-trans.processes') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($my_parents as $my_parent)
            <tr>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->name_father }}</td>
                <td>{{ $my_parent->phone_father }}</td>
                <td>{{ $my_parent->job_father }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ __('grades-trans.edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"
                            title="{{ __('grades-trans.delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
