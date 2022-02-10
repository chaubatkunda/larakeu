<div class="mb-3">
    <x-label>Price</x-label>
    <x-input type="text" name="price" placeholder="10.000" value="{{ old('price') ?? $pemasukan->price }}" />
    <x-validation-message name="price" />
</div>
<div class="mb-3">
    <x-label>Keterangan</x-label>
    <textarea name="keterangan" id="keterangan" class="form-control"
        placeholder="Keterangan">{{ old('keterangan') ?? $pemasukan->keterangan }}</textarea>
    <x-validation-message name="keterangan" />
</div>
