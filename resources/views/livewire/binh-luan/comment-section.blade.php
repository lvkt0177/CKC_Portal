<div class="container mt-4">
    <div class="comments-section">
        <div class="comments-header">
            <h4 class="comments-title">
                <i class="fas fa-comments"></i>
                Bình luận
            </h4>
        </div>

        <div class="comment-form">
            <div class="d-flex">
                <div class="me-2">
                    <img class="rounded-circle" src="{{ asset('' . auth()->user()->hoSo->anh) }}" alt=""
                        height="60px" width="60px">
                </div>
                <div class="flex-grow-1">
                    <form wire:submit.prevent="guiBinhLuan">
                        <textarea class="form-control" wire:model="noi_dung_chinh" placeholder="Viết bình luận..."></textarea>

                        @error('noi_dung_chinh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="comments-list">
            @foreach ($binhLuans as $binhluan)
                <div class="comment-item">
                    <div class="comment-header">
                        <div class="me-2">
                            <img class="rounded-circle" src="{{ asset('' . $binhluan->nguoiBinhLuan->hoSo->anh) }}"
                                alt="" height="60px" width="60px">
                        </div>
                        <div>
                            <div class="comment-author">{{ $binhluan->nguoiBinhLuan->hoSo->ho_ten }}</div>
                            <div class="comment-date">
                                <i class="fas fa-clock me-1"></i>
                                {{ $binhluan->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="comment-content">
                        {{ $binhluan->noi_dung }}
                    </div>
                    <div class="comment-actions">
                        <button class="comment-action-btn reply-btn" wire:click="setReplyTo({{ $binhluan->id }})">
                            <i class="fas fa-reply"></i>
                            Trả lời
                        </button>
                        <form wire:submit.prevent="xoaBinhLuan({{ $binhluan->id }})">
                            <div class="d-flex justify-content-end gap-2 mt-2">
                                <button type="button" class="btn btn-outline-danger reply-btn"
                                    onclick="confirmDelete({{ $binhluan->id }})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    @if ($id_binh_luan_cha === $binhluan->id && $id_binh_luan_cha !== null)
                        <div class="">
                            <div class="d-flex">
                                <div class="me-2">
                                    <img class="rounded-circle" src="{{ asset('' . auth()->user()->hoSo->anh) }}"
                                        alt="" height="60px" width="60px">
                                </div>
                                <div class="flex-grow-1">
                                    <form wire:submit.prevent="guiBinhLuan">
                                        <input type="hidden" wire:model="id_binh_luan_cha">

                                        <textarea class="form-control" wire:model.defer="noi_dung.{{ $binhluan->id }}" placeholder="Trả lời bình luận..."></textarea>

                                        @error("noi_dung.$binhluan->id")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="d-flex justify-content-end gap-2 mt-2">
                                            <button type="button" wire:click="$set('id_binh_luan_cha', null)"
                                                class="btn-reply-cancel cancel-reply">
                                                <i class="fas fa-times me-1"></i> Hủy
                                            </button>
                                            <button type="submit" class="btn-reply-submit">
                                                <i class="fas fa-paper-plane me-1"></i> Trả lời
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>


                <div class="reply-comment">
                    @foreach ($binhluan->binhLuanCon as $phanhoi)
                        <div class="comment-item">
                            <div class="comment-header">
                                <div class="d-flex justify-content-between">
                                    <div class="me-2">
                                        <img class="rounded-circle"
                                            src="{{ asset('' . $phanhoi->nguoiBinhLuan->hoSo->anh) }}" alt=""
                                            height="60px" width="60px">
                                    </div>
                                    <div>
                                        <div class="comment-author">{{ $phanhoi->nguoiBinhLuan->hoSo->ho_ten ?? '' }}
                                        </div>
                                        <div class="comment-date">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $phanhoi->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-content">
                                {{ $phanhoi->noi_dung }}
                            </div>
                            <div class="comment-actions">
                                <button class="comment-action-btn reply-btn"
                                    wire:click="setReplyToReply({{ $binhluan->id }}, {{ $phanhoi->id }})">
                                    <i class="fas fa-reply"></i>
                                    Trả lời
                                </button>
                                <form wire:submit.prevent="xoaBinhLuan({{ $phanhoi->id }})">
                                    <div class="d-flex justify-content-end gap-2 mt-2">
                                        <button type="button" class="btn btn-outline-danger reply-btn"
                                            onclick="confirmDelete({{ $phanhoi->id }})">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            @if ($id_reply === $binhluan->id && $box_reply === $phanhoi->id)
                                <div class="">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <img class="rounded-circle"
                                                src="{{ asset('' . auth()->user()->hoSo->anh) }}" alt=""
                                                height="60px" width="60px">
                                        </div>
                                        <div class="flex-grow-1">
                                            <form wire:submit.prevent="guiBinhLuan">
                                                <input type="hidden" wire:model="id_binh_luan_cha">

                                                <textarea class="form-control" wire:model.defer="noi_dung.{{ $binhluan->id }}" placeholder="Trả lời bình luận..."></textarea>

                                                @error("noi_dung.$binhluan->id")
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                                <div class="d-flex justify-content-end gap-2 mt-2">
                                                    <button type="button" class="btn-reply-cancel cancel-reply"
                                                        wire:click="$set('id_reply', null)">
                                                        <i class="fas fa-times me-1"></i> Hủy
                                                    </button>
                                                    <button type="submit" class="btn-reply-submit">
                                                        <i class="fas fa-paper-plane me-1"></i> Trả lời
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

</div>


<script>
    function confirmDelete(id) {
        if (confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
            Livewire.dispatch('xoaBinhLuan', {
                id
            });
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const emojiReactions = document.querySelectorAll('.emoji-reaction');
        emojiReactions.forEach(reaction => {
            reaction.addEventListener('click', function() {
                this.classList.toggle('active');
                const count = this.querySelector('span');
                let currentCount = parseInt(count.textContent);
                if (this.classList.contains('active')) {
                    count.textContent = currentCount + 1;
                } else {
                    count.textContent = Math.max(0, currentCount - 1);
                }
            });
        });

        const replyButtons = document.querySelectorAll('.reply-btn');
        const cancelButtons = document.querySelectorAll('.cancel-reply');

        replyButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.reply-form').forEach(form => {
                    form.classList.remove('show');
                });

                const replyForm = this.closest('.comment-item').querySelector('.reply-form');
                if (replyForm) {
                    replyForm.classList.add('show');
                    const textarea = replyForm.querySelector('textarea');
                    textarea.focus();
                }
            });
        });

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const replyForm = this.closest('.reply-form');
                replyForm.classList.remove('show');
                replyForm.querySelector('textarea').value = '';
            });
        });

        const textarea = document.querySelector('textarea');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 200) + 'px';
        });
    });
</script>
