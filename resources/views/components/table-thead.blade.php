<thead>
    <tr>
        {{ $slot }}
        @if (!is_null($title))
            <th class="fw-bold">
                <div class="btn-group" role="group">
                    <span class="h-20 flex-shrink-0">
                        <input type="checkbox" id="checkAllItems" class="filled-in chk-col-success">
                        <label for="checkAllItems"></label>
                    </span>
                    <span class="mx-2">#</span>
                    <span class="mx-3">
                        {{ $title }}
                    </span>
                </div>
            </th>
        @endif
        @foreach ($columns as $columnName)
            <th class="text-center">
                {{ $columnName }}
            </th>
        @endforeach
    </tr>
</thead>
