<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <div class="container my-5">
        <div style="max-width: ; margin: 0 auto;">
            <form action="">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th>Column</th>
                            <th>Data Type</th>
                            <th>Nullable</th>
                            <th>Column Key</th>
                            <th>Default</th>
                            <th>Reference</th>
                            <th>Validation</th>
                            <th>Input</th>
                        </tr>
                    </thead>
                    @php
                        $table = 'users';
                        $fillable = [];
                        $rules = [];
                    @endphp
                    @foreach (collect($columns)->whereNotIn('COLUMN_NAME', config('crd.unwanted_columns', [])) as $column)
                        <tr>
                            <td>{{ $column->COLUMN_NAME }}</td>
                            <td>{{ $column->COLUMN_TYPE }}</td>
                            <td>{{ $column->IS_NULLABLE }}</td>
                            <td>{{ $column->COLUMN_KEY }}</td>
                            <td>{{ $column->COLUMN_DEFAULT }}</td>
                            <td>{{ $column->REFERENCED_TABLE_NAME }}</td>
                            <td>
                                {{-- @dump($column->COLUMN_DEFAULT) --}}
                                @php
                                    $validation = '';
                                    if ($column->IS_NULLABLE == 'NO' && $column->COLUMN_DEFAULT === null) {
                                        $validation = 'required';
                                    } else {
                                        $validation = 'nullable';
                                    }
                                    if ($column->DATA_TYPE == 'varchar') {
                                        $validation .= "|string|max:$column->CHARACTER_MAXIMUM_LENGTH";
                                    } elseif ($column->DATA_TYPE == 'tinyint') {
                                        $validation .= '|in:0,1';
                                    } elseif ($column->DATA_TYPE == 'char') {
                                        $validation .= "|string|max:$column->CHARACTER_MAXIMUM_LENGTH";
                                    } elseif ($column->COLUMN_TYPE == 'date') {
                                        $validation .= '|date_format:d/m/Y';
                                    }
                                    if ($column->COLUMN_KEY == 'UNI') {
                                        $validation .= "|unique:$table,$column->COLUMN_NAME";
                                    }
                                @endphp

                                {{ $validation }}
                            </td>
                            <td>
                                @if ($column->DATA_TYPE == 'tinyint')
                                    <x-select :name="$column->COLUMN_NAME" :options="config('crd.boolean_options', [''])" :value="$column->COLUMN_NAME" />
                                @elseif ($column->DATA_TYPE == 'date')
                                    <x-input :name="$column->COLUMN_NAME" class="date" />
                                @elseif ($column->REFERENCED_TABLE_NAME)
                                    ${{ $column->REFERENCED_TABLE_NAME }}
                                    <x-select :name="$column->COLUMN_NAME" :options="config('crd.boolean_options', [''])" :value="$column->COLUMN_NAME" />
                                @else
                                    <x-input :name="$column->COLUMN_NAME" />
                                @endif
                            </td>
                            @php
                                $fillable[] = $column->COLUMN_NAME;
                                $rules[$column->COLUMN_NAME] = $validation;
                            @endphp
                        </tr>
                    @endforeach
                </table>
                Fillable
                <pre>
                   protected $fillable = [{{ collect($fillable)->join(', ') }}];
                </pre>

                Validation Rules
                {{-- blade-formatter-disable --}}
                <pre>
                   $rules = [
                @foreach ($rules as $key => $rule)
                '{{ $key }}' => '{{ $rule }}',
                @endforeach
            ];
                </pre>
                {{-- blade-formatter-enable --}}

                <button name="submit" value="all" class="btn btn-primary">Generate All</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
</body>

</html>
{{-- 
<table class="table">
    <tr>
        <th width="35"><input id="checkAll" type="checkbox"></th>
        <th width="40">No.</th>
        <th>Table Name</th>
        <th>Action</th>
    </tr>
    @foreach ($tables as $table)
        <tr>
            <td>
                <input type="checkbox" name="tables" value="{{ $table }}">
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $table }}</td>
            <td>
                <button name="single_table" value="{{ $table }}" class="btn btn-warning btn-sm">
                    Generate
                </button>
            </td>
        </tr>
    @endforeach
</table> --}}
