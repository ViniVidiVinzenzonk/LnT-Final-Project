Folder Structure:

app/

├── Http/

│   ├── Controllers/

│   │   ├── AuthController.php         # login, register, logout

│   │   ├── BarangController.php       # CRUD barang (admin)

│   │   ├── UserBarangController.php   # katalog + faktur (user)

│   │   └── karyawanController.php     # CRUD karyawan

│   └── Middleware/

│       ├── AdminMiddleware.php        # proteksi halaman admin

│       └── AuthUserMiddleware.php     # proteksi halaman user

├── Models/

│   ├── User.php

│   ├── Barang.php

│   ├── Kategori.php

│   ├── Faktur.php

│   ├── FakturItem.php

│   └── karyawan.php

database/

├── migrations/

└── seeders/

resources/views/

├── auth/          # login, register

├── admin/         # halaman admin

├── user/          # katalog + faktur

├── karyawans/     # CRUD karyawan

└── layout/        # master template
