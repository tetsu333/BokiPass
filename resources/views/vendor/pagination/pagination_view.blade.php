<!-- カスタムページネーション専用 -->
@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        <!-- 最初のページへのリンク -->
            <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a>
            </li>

        <!-- 前のページへのリンク -->
        <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
        </li>

        <!-- ページ数を表示 -->
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                      <div style="display: flex; justify-content: center; align-items: center;">
                        <!-- 現在のページ -->
                        <li class="active" aria-current="page"><span>&nbsp;{{ $page }}</span></li>
                        <!-- 現在のページと最後の総ページの間の「/」 -->
                        &nbsp;/&nbsp;
                        <!-- 総ページ数（＝最後のページ） -->
                        <li class="active" aria-current="page"><span>{{ $paginator->lastPage() }}&nbsp;</span></li>
                      </div>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- 次のページへのリンク -->
        <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
        </li>

        <!-- 最後のページへのリンク -->
        <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
        </li>
    </ul>
@endif