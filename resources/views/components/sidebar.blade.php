<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Perpustakaan</h2>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ session('role') == 'admin' ? url('/dashboard') : url('/dashboard-siswa') }}">
                Dashboard
            </a>
        </li>

        @if(session('role') == 'admin')
            <li>
                <a href="{{ url('/buku') }}">
                    Data Buku
                </a>
            </li>

            <li>
                <a href="{{ url('/anggota') }}">
                    Data Anggota
                </a>
            </li>

            <li>
                <a href="{{ url('/user') }}">
                    Data User
                </a>
            </li>

            <li>
                <a href="{{ url('/transaksi') }}">
                    Transaksi
                </a>
            </li>
        @endif

        @if(session('role') == 'siswa')
            <li>
                <a href="{{ url('/list-buku') }}">
                    List Buku
                </a>
            </li>

            <li>
                <a href="{{ url('/pinjam') }}">
                    Pinjam Buku
                </a>
            </li>
        @endif

        <li>
            <a href="{{ url('/logout') }}">
                Logout
            </a>
        </li>
    </ul>
</aside>

<style>
/* CSS kamu tidak perlu diubah, biarkan tetap seperti ini */
.sidebar {
    width: 250px;
    min-height: 100vh;
    background-color: #1e293b;
    color: white;
    padding: 20px;
}

.sidebar-header {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
}

.sidebar-menu li {
    margin-bottom: 10px;
}

.sidebar-menu a {
    display: block;
    text-decoration: none;
    color: white;
    padding: 12px;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar-menu a:hover {
    background-color: #334155;
}
</style>
