 <div class="table-responsive">
                        <table class="table table-sm" id="index-artiste">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Album</th>
                                <th class="text-center">Type jaquette</th>
                                <th class="text-center">Distributeur</th>
                                <th class="text-center">Quantité</th>
                                @can('edit_oeuvres', 'delete_oeuvres')
                                    <th class="text-center">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $oeuvres)
                                <tr>
                                    <td class="text-center">{{ $oeuvres->id }}</td>
                                    <td class="text-center">{{ $oeuvres->nom }}</td>
                                    <td class="text-center">{{ $oeuvres->titre }}</td>
                                    <td class="text-center">{{ $oeuvres->name }}</td>
                                    <td class="text-center">{{ $oeuvres->distributeur }}</td>
                                    <td class="text-center">{{ $oeuvres->qte }}</td>

                                    @can('edit_oeuvres')
                                        <td class="text-center">
                                            @include('shared._actionsOeuvre', [
                                                'entity' => 'oeuvres',
                                                'id' => $oeuvres->id
                                            ])
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>

                        </table>
    </div>