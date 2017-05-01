<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                {{ $title or '' }}
            </h4>
            <small>{{ $description or '' }}</small>
        </div>

        <div class="heading-elements">
            {{ $elements or '' }}
        </div>

    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home2 position-left"></i> Home
            </li>
            {{ $breadcrumb or '' }}
        </ul>
    </div>
</div>
<!-- /page header -->