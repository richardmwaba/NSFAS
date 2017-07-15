@extends('layouts.authorized')

@section('title', 'Projects')
@section('heading','Projects information')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">project info</div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="ProjectName" data-sortable="true">Project Name</th>
                            <th data-field="description" data-sortable="true">Description</th>
                            <th data-field="projectCoordinator" data-sortable="true">Coordinator</th>
                            <th data-field="startDate" data-sortable="true">Start Date</th>
                            <th data-field="endDate" data-sortable="true">End date</th>
                            <th data-field="income" data-sortable="true">Income</th>
                            <th data-field="allocatedBudget" data-sortable="true">Budget</th>
                            <th data-field="approved" data-sortable="true">Budget Status</th>
                            <th data-field="moreInfo" data-sortable="true">More Budget Info</th>
                        </tr>
                        </thead>
                        @foreach( $record as $rcd)
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td> @if(isset($rcd)) {{ $rcd->projectName }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->description }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->projectCoordinator }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->startDate }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->endingDate }} @endif </td>
                                <td> @if(isset($rcd)) K{{ $rcd->totalAmount->incomeAcquired }}.00 @endif </td>
                                <td> @if(isset($rcd))
                                        @if(Auth::user()->access_level_id == 'OT')

                                            @if($rcd->budget->approved  == 0)
                                                K{{ $rcd->totalAmount->proposedBudget }}.00
                                                @if($rcd->totalAmount->proposedBudget < $rcd->budget->actualProjectBudget)
                                                    <div class="btn-group">
                                                        <a href="{{ route('/projectBudget', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link" >
                                                            Add Budget items</a>
                                                    </div>
                                                @endif
                                            @else
                                                K{{ $rcd->totalAmount->proposedBudget }}.00
                                            @endif

                                        @elseif(Auth::user()->access_level_id == 'HD')
                                            K{{ $rcd->totalAmount->proposedBudget }}.00
                                        @endif
                                    @endif
                                </td>
                                <td> @if(isset($rcd))
                                        @if(Auth::user()->access_level_id == 'OT')
         �$��ćq�������$j�pT`�u���a�QBŅm�w�"*or��&am-\�W%�{�]���U�'"�x��b� ؏8��o\�Z��9�G[������eFT^i�O�%�ձ"����G�w��e(�S��9Xt���T�{����4	&���ƈ�4�(�^jˡ�C�f9��ȗ�c�:�q<Ԑ7��%�}��T��㕼G��',�$O��[@�8ɸ�7<��g�qZ�R��mwM؊8-�4�`��o��{b����r���s�g[bdlae|^�`��L���t�@�Ӆ�.�t���y��ߏ�68���:{ĵ�<�bVR4M�,�L���/�8���-�0�c2�I��)���U9/�u��e4����Z�+%�Y_q۶no���R,o[�j������'�ܷI����_P���0Ŵ��rd[�i�Vѫ�"���LdE�sYi�� e�mD�vS��4�b�f�T����N��;b�L���j�-:93�"��.�wM��W�ǜ�5�~�lZ.���q�V	���4�Wo�f��)�i"~x� ��Z`�L/$m�l����W��=�+k�~@�a1C�s.d��Z}|�y�㈌x�%�N�O��X��٦�r٘�Lx �:0�D�_�!�_e�9B��HC��z�4�< �Py~'⺓�9��{N>m����,�>��F��=9#cA	����f�A�/��b!�5%�=�N��4���z _��iu�"ۜ��>�k*��h��;��� �S�r�:�d*��G���)e^����D����kD0Ua����$�2IU�F���_sh5�[
�~�%X��i�c����M�&�:�NV��)a�!=�Ka��%BO!���Ńos�04P��'
m�,��\��s�_�x���d���<-_�ţ�� �L���P>��24����\����_�hKZFގ>�&��'��-�X�ʳZE�Wi�O��B��U�Z*>��Y@�y�j0G�1�� ���G�*A�����cBG�з��.N����-��.���y@^@������/_�Z:� �~�m�]H������@	���K����3(�����_��cϘ��� E+�k����R���;)6g��ud�x���vs�%�(�!�3e�l����̍��f�w�~C��P�ˤe�����5ф�f��� ���ͩ���41�vO�f�~�.�|�+F���Q�jQ���c#tT�6H ~$�>ez&'�J�Sz%��v��P�2����9�����3zBl- N�[g�y��A����`*�>�;�ls�5}gl|�"�-*sC	ꪒ��=+Ю�)�հGN`-�"�p��GH�+zw�X�Q���J�v�A��6LM�@e�eh���r�"ܘ�&]��`mF2�!��o;b}e�!J\Z�����-GJ�������
1����v�5 ����/���&��ɒ�uGGQW
����o/|aU��[��H�6k� g�	�K�p�Kx��>+�'f����ֿ�vp�s��8��jV~�v����o�;2����s;E3>��nV}���v��o��w��2���ɴw3��e���Н����|d�Nù�ͦ����U��9/i��pZ]�j��i�b'=����P�A�'T�8A�S�/���&	P>�����G�܉~b�N�U�T�wޞ<���l�ת�P(�܆Z@7-K>��&p�`�Zsо��? g|�@�]��5��V�W�^�,Z'y�
� �IRQ`��^0IP���:����f��-�ߕ�m�*�s�6��w�96#b'��F�%�yԏÚl&C�~W��|��H�p,�a��D�h29+���E0�����# �l�Hq�W���-����a��"pu7�$�Ta?l�^^&��*}@y�4��~t9�<¸9ʎ�TL�ü��c$���?��ѝ��K]fv�����F�n�J+���q�0����!^�`W��Pd�%\*�+L�����7�CUzfM�]ծ��߁)Ltk���];�� =3�B;��p�^ȭ+�]qj�S>���qФgbr��13['�>��\��+$��nGئ2���`�]�����*��X��M��b|3.e�E�k���}���t�������V�Q��[ea���whؓ�h�=_xu�0R.�&B��?�QJ<[�$�~6�u)���&g�3t�ʟSo�We�e��� Bs%��ǥi��ˣ���{}'��@��bJ�0�V˄[k|���-mڴ���>2z6�E�Hz��A��� F�HtDN�����h�k!}v+���Ch�3�j��釿�հ�[�ϱ���Oe)3@��^�{�t!�^U�����Y�V��+���_����+(;l��d!����Z�-�Aߵ��:!��I�c&P{`}{�..�i�4�ierE� |	0���uǃح3�
u6�l�K'���F�,�[:����m.oĳ����3�A����|#�(<��+�?a2k�7{ڞˊ�x嘿QzΟ��)��6dBJ���n��t��q�tXbb�]�Q��ؗ�C�m�b�S��9K�q�� �2.�_Y=�n�,��vH�����h����W[[r'�b�-��ġ�Ʒ#\
d6�1R_f�c3o�^pu�d�� 8w�
�
��e)=N�׼�sG�n����|��ۖ+~haG`�&X��h\	�My���(2�Ai�/B�˖8���T�؝�k�[V�	!��0��l���ϔ��pɷ�)�,~30'@ŞéMz�n	��9#�10�<a��3ui��us��K6Jg�M��U�:�#�fu���0
���@䧻��M�w��>"��+���y����k����*�/������!�j��E�ߖl�+�g?��?�-���!X"�6�
=�@��G�ܴKK�7ll�3-��F)F���AC\���E�F���Mȍ5�^/������6>�d���2pR�Z�޾�<ż�Ԩ6m�0fbj�[��4q^9;H�Jcج���(�&1̨ʪ}Hoz}<��́@wMоӨ9ݻ�82Ѱ�-�`(��4B���$T9�WXֵJ��9�L8i�M����BP�����|�жW撦:Rr9�����2*B��ƌs�R�2XŕNz*20�=��J�����a�b�������"��S�Qv��\}_�*|��M��I�}k��ůT�7�����b��������I�O�:��z_>)?�Y�"����G�zl�)c �H�k��4�k ��k����􎤳�2r<*�9��+�V�[�=�F�@��\�9�j3w�4-�}��*_�I~f��T%���䅁���_��)�|f���g?Q��K:֙ �%8��D��a!֯��+��	ٚΙ��ɯr��3;�&���޹��E=��h\w�e|� ���6��a�;r�j�����w�7���L���^�m�����ℒ��3c��7e�W����a�e���C��G}�WU��7�a^�4�β��|1���z��i�=���ɋ��v�l���j��Q��'�3��:�ܾN�N�g��.OM%m*b�3���mK�D�i�d}�*�*�*��g�����d�'�Z�	����Z=?m��z윿�$ڡ�֐>��t�sH`���y�%)�L�F��TM4J&:r��he��Z��9�"ߙ�X�C̀���/n��z�p[DT�[��ف-�YW�쎕�{�b���p+�~%��щ�q_�-7Lk�[`��U��U��b��ǡ��KG����@l4�F6%n1���I��# �q�L��O��"H����C�k3X��m8tDz�����ᕠa]�lx�u��J�o|��3ol���}hdJ*
���U�YN;
�٫�����36=��5u���++�:�2]H����A�]�I��1���TؼV@�9�h��|�[w�uR�4?�'��&9/�>V:�06��G��[��n��������b�q�|�Y<u���ϲ�=��~⃦)��B��](�<������D�C�{g� �w�O|W_`�TvL9�i��T�>�F`�             }
                    </script> <!--/. script-->

                    <script>
                        function delete_user(user, man) {
                            var xhttp;
                            if (window.XMLHttpRequest) {
                                xhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            if (confirm("Are you sure you want to delete " + user + "?")) {
                                xhttp.open("GET", "{{url('delete_user')}}/" + man, false);
                                xhttp.send();
                                alert(user + " has been deleted!");
                                location.reload();
                            }
                        }
                    </script>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    @parent
    <!-- Custom Table JavaScript -->
    <script>
        !function ($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        });
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
    <!-- /.Custom Table JavaScript -->
@endsection