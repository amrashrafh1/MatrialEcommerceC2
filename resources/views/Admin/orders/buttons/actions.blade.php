
        <div class="actions">
            <div class="btn-group">
                <a class="btn btn-default btn-outlines btn-circle" href="javascript:;" data-toggle="dropdown"
                    data-hover="dropdown" data-close-others="true" aria-expanded="false">
                    <i class="fa fa-wrench"></i>

                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li class="divider"> </li>
                    <li>
                        <a href="{{ route('orders.edit', $id)}}" class="p-3"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                    </li>
                    <li>
                        <a href="{{ route('orders.show', $id)}}" class="p-3"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
                    </li>
                </ul>
            </div>
        </div>
