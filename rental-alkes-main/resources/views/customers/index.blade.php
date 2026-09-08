<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Pelanggan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola data kontak, nomor telepon, alamat, dan unit yang disewa pelanggan.</p>
    </x-slot>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <!-- Header Card: Judul, Search Bar with Custom Suggestions, & Tombol Tambah -->
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; gap: 16px;">
            <div style="font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">
                Daftar Pelanggan
            </div>

            <div style="display: flex; gap: 10px; align-items: center; justify-content: flex-end;">
                
                <!-- Form Pencarian dengan Custom Suggestions Box -->
                <form action="{{ route('customers.index') }}" method="GET" style="display: flex; gap: 6px; align-items: center; margin: 0; position: relative;">
                    <div style="position: relative;">
                        <input type="text" id="searchInput" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama / telepon..." style="padding: 7px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.813rem; background: #ffffff; width: 220px;" autocomplete="off">
                        
                        <!-- Custom Suggestion Dropdown Box (Kecil, Rapi, Scrollable) -->
                        <div id="suggestionBox" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); max-height: 200px; overflow-y: auto; z-index: 50; margin-top: 4px;">
                            @foreach($allCustomers as $c)
                                <div class="suggestion-item" data-value="{{ $c->nama }}" style="padding: 8px 12px; font-size: 0.813rem; cursor: pointer; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-weight: 600; color: #0f172a;">{{ $c->nama }}</span>
                                    <span style="font-size: 0.75rem; color: #64748b; font-family: monospace;">{{ $c->telepon }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" style="background: #334155; color: #ffffff; padding: 7px 12px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; border: none; cursor: pointer;">Cari</button>
                    @if(isset($search) && $search)
                        <a href="{{ route('customers.index') }}" style="background: #f1f5f9; color: #475569; padding: 7px 10px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; text-decoration: none;">Reset</a>
                    @endif
                </form>

                <a href="{{ route('customers.create') }}" style="background: #059669; color: #ffffff; padding: 7px 14px; border-radius: 8px; font-weight: 700; font-size: 0.813rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 6px;">
                    <span>+</span> Tambah Pelanggan
                </a>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Nama Pelanggan</th>
                        <th style="padding: 14px 24px;">No. Telepon / WhatsApp</th>
                        <th style="padding: 14px 24px;">Unit Disewa</th>
                        <th style="padding: 14px 24px;">Alamat</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @forelse($customers as $index => $customer)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">
                                {{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}
                            </td>
                            <td style="padding: 16px 24px; font-weight: 700; color: #0f172a;">{{ $customer->nama }}</td>
                            <td style="padding: 16px 24px; color: #475569; font-family: monospace;">{{ $customer->telepon }}</td>
                            <td style="padding: 16px 24px;">
                                @foreach($customer->active_units_list as $uName)
                                    <span style="background: #f0fdf4; color: #166534; padding: 3px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700; border: 1px solid #bbf7d0; display: block; width: fit-content; margin-bottom: 3px;">
                                        &bull; {{ $uName }}
                                    </span>
                                @endforeach
                            </td>
                            <td style="padding: 16px 24px; color: #334155;">{{ $customer->alamat }}</td>
                            <td style="padding: 16px 24px; text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center;">
                                    <a href="{{ route('customers.edit', $customer->id) }}" style="background: #eff6ff; color: #2563eb; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none;">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Hapus pelanggan?');" style="margin: 0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding: 32px; text-align: center;">Belum ada data pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">{{ $customers->links() }}</div>
    </div>

    <!-- Script buat ngontrol Custom Suggestion Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('searchInput');
            const box = document.getElementById('suggestionBox');
            const items = box.querySelectorAll('.suggestion-item');

            input.addEventListener('focus', function() {
                box.style.display = 'block';
            });

            input.addEventListener('input', function() {
                const val = this.value.toLowerCase();
                box.style.display = 'block';
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(val)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            items.forEach(item => {
                item.addEventListener('click', function() {
                    input.value = this.getAttribute('data-value');
                    box.style.display = 'none';
                });
            });

            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !box.contains(e.target)) {
                    box.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>