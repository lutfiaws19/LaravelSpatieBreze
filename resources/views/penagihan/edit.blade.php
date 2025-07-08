<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesan Penagihan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.25);
        }

        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #7c3aed, #4f46e5);
        }

        .btn-secondary {
            background-color: #f3f4f6;
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }
    </style>
</head>
<body class="py-12">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8 animate__animated animate__fadeInDown">
            <h2 class="text-3xl font-bold text-gray-800">
                Edit Pesan Penagihan untuk <span class="text-indigo-600">{{ $antrian->nama_pemilik }}</span>
            </h2>
        </div>

        <!-- Main Content -->
        <div class="card bg-white rounded-xl overflow-hidden shadow-xl animate__animated animate__fadeInUp mb-6">
            <div class="p-6">
                <div class="mb-4">
                    <strong class="text-lg">Nomor Motor:</strong> <span class="text-gray-700">{{ $antrian->nomor_motor }}</span><br>
                    <strong class="text-lg">Tipe Motor:</strong> <span class="text-gray-700">{{ $antrian->type_motor }}</span>
                </div>
                <form action="{{ route('penagihan.update', $penagihan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="pesan" class="block text-gray-700 font-medium">Pesan Penagihan</label>
                        <textarea name="pesan" id="pesan" class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" required>{{ old('pesan', $penagihan->pesan) }}</textarea>
                    </div>
                    <div class="flex items-center justify-end space-x-4">
                        <button type="submit" class="btn-primary">Update</button>
                        <a href="{{ route('antrian.index', $antrian->id) }}" class="btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

</x-app-layout>