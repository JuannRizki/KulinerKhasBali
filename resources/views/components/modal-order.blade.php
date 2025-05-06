<!-- resources/views/components/modal-order.blade.php -->
@props([
    'show' => false,
    'order' => null, // Menambahkan order sebagai prop
])

<div
    x-data="{
        show: @js($show),
        orderId: @js($order->id),
        orderStatus: @js($order->status),
    }"
    x-init="show = @js($show)"
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75"
    @click.self="show = false"
    style="display: none;"
>
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-2xl font-semibold mb-4">Edit Pesanan #{{ $order->id }}</h2>
        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" x-model="orderStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                    <option value="pending" :selected="orderStatus == 'pending'">Pending</option>
                    <option value="completed" :selected="orderStatus == 'completed'">Completed</option>
                    <option value="canceled" :selected="orderStatus == 'canceled'">Canceled</option>
                </select>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" @click="show = false" class="bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>
