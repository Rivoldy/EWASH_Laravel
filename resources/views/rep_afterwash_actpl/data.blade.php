    <div class="container">
        <h2>Report Data</h2>
        <table class="table table-sm table-hover table-bordered table-striped table-bordered" style="width: 100%;" id="tabsku">
            <thead>
                <tr>
                    <th class="text-center"><sub>Color</sub> / <sup>Size</sup></th>
                    <!-- Add table headers here based on your data -->
                    <th class="text-center">TOTAL QTY</th>
                    <th class="text-center">TOTAL BAG</th>
                    <th class="text-center">TOTAL NW</th>
                    <th class="text-center">TOTAL GW</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->color }}</td>
                        <!-- Add table data rows here based on your data -->
                        <td class="text-right">{{ number_format($item->qty) }}</td>
                        <td class="text-right">{{ number_format($item->karung) }}</td>
                        <td class="text-right">{{ number_format($item->nett, 2) }}</td>
                        <td class="text-right">{{ number_format($item->gross, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center" colspan="5">GRAND TOTAL</th>
                    <th class="text-right">{{ number_format($grandTotalQty) }}</th>
                    <th class="text-right">{{ number_format($grandTotalBag) }}</th>
                    <th class="text-right">{{ number_format($grandTotalNW, 2) }}</th>
                    <th class="text-right">{{ number_format($grandTotalGW, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
