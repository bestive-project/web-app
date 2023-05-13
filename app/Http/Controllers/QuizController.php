<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\QuizRequestStore;
use App\Models\Chapter;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    protected $chapter, $quiz;

    public function __construct(Chapter $chapter, Quiz $quiz)
    {
        $this->chapter = $chapter;
        $this->quiz = $quiz;
    }

    public function index(Request $request)
    {
        $quiz = $this->quiz->where("uuid", $request->quiz_id)->first();
        if (!$quiz) {
            abort(404);
        }

        $data = [
            "quiz" => $quiz
        ];

        return view('quiz.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(QuizRequestStore $request)
    {
        DB::beginTransaction();

        $chapter = $this->chapter->where("uuid", $request->chapter_id)->first();
        if (!$chapter) {
            abort(404);
        }

        try {
            if ($chapter->quiz) {
                $chapter->quiz()->update([
                    "link_quiz" => $request->link_quiz
                ]);
            } else {
                $chapter->quiz()->create($request->all());
            }

            DB::commit();
            return redirect(route('web.course.show', $request->course_id))->with("successMessage", '<script>swal("Selamat!", "kuis berhasil di simpan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $quizId)
    {
        $quiz = $this->quiz->where("uuid", $quizId)->first();
        if (!$quiz) {
            abort(404);
        }

        $data = [
            "quiz" => $quiz
        ];

        return view('quiz.index', $data);
    }

    public function edit(Quiz $quiz)
    {
        //
    }

    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    public function destroy(Quiz $quiz)
    {
        //
    }
}
