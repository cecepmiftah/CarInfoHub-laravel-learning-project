<x-app-layout>
    <main>
        <!-- New Cars -->
        <section>
            <div class="container">
                <div class="flex justify-between items-center">
                    <h2 class="text-center font-bold">My Favourite Cars</h2>
                    @if ($cars->total() > 0)
                        <div class="pagination-summary">
                            <p>
                                Showing {{ $cars->firstItem() }} to
                                {{ $cars->lastItem() }} of {{ $cars->total() }} results
                            </p>
                        </div>
                    @endif
                </div>
                <div class="car-items-listing">
                    @forelse ($cars as $car)
                        <x-car-item :$car :isInWatchlist="true" />
                    @empty
                        <div class="text-base italic">
                            <h2>No cars in your watchlist</h2>
                            <p>Browse our collection and add cars to your watchlist.</p>
                        </div>
                    @endforelse

                </div>

                {{-- Paginations --}}
                {{ $cars->onEachSide(1)->links() }}
            </div>
        </section>
        <!--/ New Cars -->
    </main>
</x-app-layout>
