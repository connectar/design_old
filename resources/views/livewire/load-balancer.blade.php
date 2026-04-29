<div>
    @if ($step === 'choose_lines')
        <form wire:submit="submitChooseLines">
            <h3>الخطوة الاولى ادخل عدد الخطوط ونوع الدمج واذا كنت تستخدم هوت اسبوت</h3>
            <label>عدد الخطوط:</label>
            <input type="number" wire:model="num" min="1" required />
            <label>نوع الدمج:</label>
            <select wire:model="balance_type" required>
                <option value="ai">الدمج الذكى بالذكاء الاصطناعى</option>
                <option value="pcc">PCC (دمج متساوي)</option>
                <option value="nth">NTH (دمج متساوي)</option>
            </select>
            <label>توثيق الهوت سبوت:</label>
            <select wire:model="hotspot_auth">
                <option value="disabled">غير مفعل</option>
                <option value="enabled">مفعل</option>
            </select>
            <button type="submit" class="btn" >التالي</button>
        </form>
    @elseif ($step === 'edit_lines')
        <form wire:submit="submitEditLines">
            <h3>عدل اسماء الكروت والايبهات الخاص بالرواتر</h3>
            <table>
                <thead>
                    <tr>
                        <th>اسم الخط</th>
                        <th>عنوان IP</th>
                        <th>البوابة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lines as $index => $line)
                        <tr>
                            <td><input type="text" wire:model="lines.{{ $index }}.wan" required /></td>
                            <td><input type="text" wire:model="lines.{{ $index }}.ip" required /></td>
                            <td><input type="text" wire:model="lines.{{ $index }}.gw" required /></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><input type="text" name="lan" wire:model="lan" value="ether{{$num }}" required /></td>
                        <td><input type="text" name="lip" wire:model="lip" value="192.168.254.1" required /></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <label>عنوان DNS:</label>
            <input type="text" wire:model="dns" required />
            <button type="submit" class="btn" >توليد الكود</button>
        </form>
    @elseif ($step === 'generate_code')
    <h3 style="font-size: 1.5rem; color: #4CAF50; margin-bottom: 10px;">Generated Code</h3>
    <div dir="ltr" style="text-align: left">
        <pre id="generated-code" style="background-color: #f5f5f5; color: #333; padding: 15px; border-radius: 5px; overflow-x: auto; font-family: monospace;">
            {{ $generatedCode }}
        </pre>
    </div>
    <button type="button" id="copy-button" class="btn">
        نسخ الكود
    </button>

    <button wire:click="resetStep" style="background-color: #DC3545; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; margin-top: 10px;">
        إعادة
    </button>
    @endif
</div>

@push('scripts')
<script>
    document.getElementById('copy-button').onclick = function() {
        // Get the content of the <pre> element
        var code = document.getElementById('generated-code').innerText;

        // Create a temporary textarea to copy the content
        var textarea = document.createElement('textarea');
        textarea.value = code;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        // Show SweetAlert after copying
        Swal.fire({
            icon: 'success',
            title: 'تم نسخ الكود بنجاح!',
            showConfirmButton: false,
            timer: 1500
        });
    };
</script>
@endpush

