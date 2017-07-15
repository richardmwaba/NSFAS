@extends('layouts.authorized')

@section('title', 'Add | Account Income')
@section('heading','Add An Income To An Account')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Recently Added Accounts</b></div>
                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="accountName" data-sortable="true">Account Name</th>
                            <th data-field="amount" data-sortable="true">Total Amount Received</th>
                            <th data-field="createdBy" data-sortable="true">Account Created By</th>
                            <th data-field="addIncome" data-sortable="true">Add Income</th>
                        </tr>
                        </thead>
                        @if(isset($records))
                            @foreach( $records as $rcd)
                                <tr>
                                    {{--<td data-field="state" data-checkbox="true"></td>--}}
                                    <td> @if(isset($rcd)) {{ $rcd->accountName }} @endif </td>
                                    <td> @if(isset($rcd)) K {{ $rcd->calculatedTotal->incomeAcquired }}.00 @endif </td>
                                    <td> @if(isset($rcd)) {{ $rcd->user->firstName }}
                                        {{ $rcd->user->otherName }} {{ $rcd->user->lastName }}@endif </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('/addAccountIncome', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link">
                                                <i class="fa fa-plus-circle fa-fw text-primary" style="font-size: medium"></i><span class="text-primary">Add Income</span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>

                    <script>
                        $(function () {
                            $('#hover, #striped, #condensed').click(function () {
                                var classes = 'table';

                                if ($('#hover').prop('checked')) {
                                    classes += ' table-hover';
                                }
                                if ($('#condensed').prop('checked')) {
                                    classes += ' table-condensed';
                                }
                                $('#table-style').bootstrapTable('destroy')
                                        .bootstrapTable({
                                            classes: classes,
                                            striped: $('#striped').prop('checked')
                                        });
                            });
                        });

                        function rowStyle(row, index) {
                            var classes = ['active', 'success', 'info', 'warning', 'danger'];

                            if (index % 2 === 0 && index / 2 < classes.length) {
                                return {
                                    classes: classes[index / 2]
                                };
                            }
                            return {};
                        }
                    </script> <!--/. s��i�O!j��'���v:�m�ylYMwFF�=��3 �Zg�x� ����7�.��6�9�����&�q��&8p\v����~`׏ U`�dPg�?��T�0%�I��s��ae
��!x�l�Ej2������!�����:�r_�+���N�[��oa������s�c�eIN|��d�CDDu�����Wt=z���|U��#,��\�6�J-�{��zlXy⺽J���g=��3G���r��2e,(�X�����7� 7eĕaS�1B�ܶ@�S��M�M�IZ�<���A~_�+�B�pP�]f�?{Q$ye�+�"$���"��k�L*	v�
�%��)��N�N������祔b�����Yv�&�׈��0��P�l�~hep��<�6�-��KYC�Lqt���I�*�c��`G�NM�����#Uzf	!P���Z/]`Nt�ɡ�yg73���z.�v�Ҫ������:iS�n��y�4�a[�"N8��V����ّ�֋$�O��H��ן9��������q�ib�@��;�xo�NJ��T߽�t���p`$br����ohv�f;�(A+W�'v���/���=+�J">Q�P�%S�{FG͋&�{�}�Pq��� 9�y������Wc��\~F8�1$�q4��O�ٳr���ׇ6�.*��Od_7� ;c�� 0���z��q�������ݹ�S�6;��
0�s�z�5d��H_�ϭjϱ���ɘd#�Hyv�lO��F{�jF=���V/���[�z]X���Zt(~�
�����\�b@�5�����i-�]����;�ۚ�����;zP�C�(d��`��pqK��0�����;���< 
��St���q�����#Y�2���
�{~lM�zr���~A=�cc�vT#B��q�@
�L�V� ��PH���fc�JZi�;Ơ�?�I�R�f��� 7�G����S�j(x�p�YD!���;��w<-{o�B#�ݝ��'wmS9�F��&~G�Ȃ�k[��<���"�u;*p|� d�h���:�H2�z��(HF�ݳ���!��"�z��IB<