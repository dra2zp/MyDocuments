(** * Induction: Proof by Induction *)

(** Before getting started, we need to import all of our
    definitions from the previous chapter: *)

Require Export LF.Basics.

(** For the [Require Export] to work, you first need to use
    [coqc] to compile [Basics.v] into [Basics.vo].  This is like
    making a .class file from a .java file, or a .o file from a .c
    file.  There are two ways to do it:

     - In CoqIDE:

         Open [Basics.v].  In the "Compile" menu, click on "Compile
         Buffer".

         (N.b.: These instructions need to be updated to take the "-R
         LF ." into account.  Can a CoqIDE expert tell me how this is
         done, please?)

     - From the command line:

         [make Basics.vo]

   If you have trouble (e.g., if you get complaints about missing
   identifiers later in the file), it may be because the "load path"
   for Coq is not set up correctly.  The [Print LoadPath.] command may
   be helpful in sorting out such issues. *)

(* 
Sullivan: A (maybe) familiar example of induction. Consider this table

  n    |    sum i in 0...n, i
----------------------------------------------
  0    |    0
  1    |    1
  2    |    3
  3    |    6
  4    |  10
  5    |  15
  6    |  21
 ...    |  ...
  n    |  ???

Graph the table so far. Observe what looks like a parabola. Conjecture 
that the function is quadratic. Try to find a quadratic formula that fits the
data. (So far this is like test-driven development!)  Here's what you get:

sum i in 0 n, i = n * (n + 1) / 2.

For each n, we get a proposition. So, for n = 5, for example, we get the
proposition that "sum i in 0..5, i = 5 * 6 / 2 = 5 * 6 / 2 = 30 / 2 = 15." Thus
this particular proposition, for the value n = 5 is true. It also checks out 
for every number in our table. But does it hold for every value of n? To
assert that it does, we write a universally quantified proposition like this:

for all n, sum 0 ... n = n * (n + 1) / 2.

Is it true? Just checking out individual cases can never show that it is true
for all possible values of n. Maybe there's some really weird, really large
number for which it turns out not to work. We can never know that there
isn't such a thing unless we have a proof that there isn't one. For that we
need a proof that covers an infinity of cases. Doing case analysis on the
*values* of type nat can never work, but doing case analysis on the ways
in which a nat can be built can work. And that is because the semantics of
inductively defined types (discuss briefly).

Such a proof therefore has two cases: one for the "base case", here, 0,
for which we have to prove that sum i in 0..0, i = 0; and a second for the 
inductive case, stating that if the property holds for an arbitrary nat, n, it 
must then also holds for (n + 1). Here's the conjecture written out in full:
sum i in 0..n, i = n * (n + 1) / 2 -> sum i in 0..(n+1), i = (n+1)((n+1)+1)/2.

Proving the base case is easy, by simplification of the sum down to 0 and
then by the reflexive property of equality: 0 = 0. Proving the inductive case
is usually where the challenge is. From this point forward, our goal is to use
this example to highlight key aspects of most proofs by induction.

First, we use a basic reasoning rule of natural deduction to turn the premise
of the goal into an assumption, in the context of which we then need to prove
the conclusion. So we get this.

Assume the property holds for n: that sum i in 0..n, i = n * (n + 1) / 2 is true,
and in this context, prove that sum i in 0..(n+1), i = (n+1) ((n+1) + 1) / 2. We
can write this graphically like this:

| IHn: sum i in 0..n, i = n * (n + 1) / 2  (assume we have a proof IHn for n)
|------------------------------------------------------
| sum i in 0..(n+1), i = (n+1) ((n+1) + 1) / 2 (what remains to be proved)

Second, we have to find a way to transform the goal so that we can use
the induction hypothesis. A crucial trick is to look for a way to rewrite the
goal so that some part of it matches one side of the induction hypothesis.
Then you can rewrite the goal using that hypothesis. Here the trick is to
see that sum i in 0..(n+1) is the same as sum i in 0..n, i + (n + 1)! 

Now, by rewriting the goal using the induction hypothesis, we see that this
is n * (n + 1) / 2 + (n + 1). This is [n * (n + 1) + 2 * (n + 1)] / 2. And this now
simplifes down to what we want. It's [n^2 + n + 2n + 2] / 2, which is equal to
[n^2 + 3n + 2] / 2, which is equal to [(n+1)((n+1)+1)] / 2. And that is equal to
n^2 + 2n + 1 + (n + 1) = n^2 + 3n + 2.

We now have a proof that if the formula holds for n, it must also hold for
(n + 1), and we have a proof that it *does* hold for zero, which is enough
to deduce that it must hold for all n. Note that proving the inductive case
alone is not enough! If you don't have a base case to "get you started",
you don't have a valid proof.

Now my proof itself is informal. Maybe it contains an error. Do you know
that there is, right now, a huge kerfluffle in the CS community over a 
putative proof that P != NP proposed by Blum? Top theoreticians around
the globe are checking his putative proof for errors. If the proof were in 
Coq, no such process would be necessary. Coq can tell you for sure if a
proof it good or not. It's good if it type checks. It's not if it doesn't! In that
case it's either erroneous or at least incomplete. Could we actually do a
proof of our little conjecture in Coq to be super-sure we haven't made a
mistake? Yeah! 

First, we need to write a little function, let's call it sumto, to compute the 
sums of numbers  from zero to n. Go ahead and write it now. You may
assume that adding the numbers up from zero to n and down from n to
zero give the same result (which is true).
*)

Fixpoint sumto (n: nat): nat :=
  match n with
    | O => O
    | S n' =>  n + (sumto n')
  end.

Compute sumto 6.

(*
Then write the proposition to be proved about that function. We haven't
yet (in Basics) defined a divide by two operator, but that's no problem: 
we'll just multiple each side of the claim to be proved by two, to get the 
following as our conjecture to be proved.
*)

Theorem quad: forall n: nat, (sumto n) * 2 = (S n) * n.
Admitted. (* We need the rest of the chapter to be able to prove it! *)


(* ################################################################# *)
(** * Proof by Induction *)

(** We proved in the last chapter that [0] is a neutral element
    for [+] on the left, using an easy argument based on
    simplification.  We also observed that proving the fact that it is
    also a neutral element on the _right_... *)

Theorem plus_n_O_firsttry : forall n:nat,
  n = n + 0.

(** ... can't be done in the same simple way.  Just applying
  [reflexivity] doesn't work, since the [n] in [n + 0] is an arbitrary
  unknown number, so the [match] in the definition of [+] can't be
  simplified.  *)

Proof.
  intros n.
  simpl. (* Does nothing! *)
Abort.

(** And reasoning by cases using [destruct n] doesn't get us much
    further: the branch of the case analysis where we assume [n = 0]
    goes through fine, but in the branch where [n = S n'] for some [n'] we
    get stuck in exactly the same way. *)

Theorem plus_n_O_secondtry : forall n:nat,
  n = n + 0.
Proof.
  intros n. destruct n as [| n'].
  - (* n = 0 *)
    reflexivity. (* so far so good... *)
  - (* n = S n' *)
    simpl.       (* ...but here we are stuck again *)
Abort.

(** We could use [destruct n'] to get one step further, but,
    since [n] can be arbitrarily large, if we just go on like this
    we'll never finish. *)

(** To prove interesting facts about numbers, lists, and other
    inductively defined sets, we usually need a more powerful
    reasoning principle: _induction_.

    Recall (from high school, a discrete math course, etc.) the
    _principle of induction over natural numbers_: If [P(n)] is some
    proposition involving a natural number [n] and we want to show
    that [P] holds for all numbers [n], we can reason like this:
         - show that [P(O)] holds;
         - show that, for any [n'], if [P(n')] holds, then so does
           [P(S n')];
         - conclude that [P(n)] holds for all [n].

    In Coq, the steps are the same: we begin with the goal of proving
    [P(n)] for all [n] and break it down (by applying the [induction]
    tactic) into two separate subgoals: one where we must show [P(O)]
    and another where we must show [P(n') -> P(S n')].  Here's how
    this works for the theorem at hand: *)

Theorem plus_n_O : forall n:nat, n = n + 0.
Proof.
  intros n. induction n as [| n' IHn'].
  - (* n = 0 *)    reflexivity.
  - (* n = S n' *) simpl. rewrite <- IHn'. reflexivity.  Qed.

(** Like [destruct], the [induction] tactic takes an [as...]
    clause that specifies the names of the variables to be introduced
    in the subgoals.  Since there are two subgoals, the [as...] clause
    has two parts, separated by [|].  (Strictly speaking, we can omit
    the [as...] clause and Coq will choose names for us.  In practice,
    this is a bad idea, as Coq's automatic choices tend to be
    confusing.)

    In the first subgoal, [n] is replaced by [0].  No new variables
    are introduced (so the first part of the [as...] is empty), and
    the goal becomes [0 = 0 + 0], which follows by simplification.

    In the second subgoal, [n] is replaced by [S n'], and the
    assumption [n' + 0 = n'] is added to the context with the name
    [IHn'] (i.e., the Induction Hypothesis for [n']).  These two names
    are specified in the second part of the [as...] clause.  The goal
    in this case becomes [S n' = (S n') + 0], which simplifies to
    [S n' = S (n' + 0)], which in turn follows from [IHn']. *)

Theorem minus_diag : forall n,
  minus n n = 0.
Proof.
  (* WORKED IN CLASS *)
  intros n. induction n as [| n' IHn'].
  - (* n = 0 *)
    simpl. reflexivity.
  - (* n = S n' *)
    simpl. rewrite -> IHn'. reflexivity.  Qed.

(*
Sullivan: Let's drill down on this a little further. Where did that
inductio hypothesis magically come from? Just remember that
to prove a [forall] for a proposition [P] about the natural numbers,
you have to show that [P] is true for [O] and that if [P] is true for
some natural number, [n], then it's true for [S n]. That is, you have
to prove [P O] and [P n -> P (S n)]. [P O] is the base case, and 
[P n -> P (S n)] is the inductive case. You just need a proof of
each of these cases. The second is an implication, with a premise
and a conclusion. The induction hypotheses is the just premise,
and Coq is automatically applying an [intro] to move it into the
context. That's it.
*)

(** (The use of the [intros] tactic in these proofs is actually
    redundant.  When applied to a goal that contains quantified
    variables, the [induction] tactic will automatically move them
    into the context as needed.) *)

(** **** Exercise: 2 stars, recommended (basic_induction)  *)
(** Prove the following using induction. You might need previously
    proven results. *)

Theorem mult_0_r : forall n:nat,
  n * 0 = 0.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem plus_n_Sm : forall n m : nat,
  S (n + m) = n + (S m).
Proof.
  (* FILL IN HERE *) Admitted.

Theorem plus_comm : forall n m : nat,
  n + m = m + n.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem plus_assoc : forall n m p : nat,
  n + (m + p) = (n + m) + p.
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 2 stars (double_plus)  *)
(** Consider the following function, which doubles its argument: *)

Fixpoint double (n:nat) :=
  match n with
  | O => O
  | S n' => S (S (double n'))
  end.

(** Use induction to prove this simple fact about [double]: *)

Lemma double_plus : forall n, double n = n + n .
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 2 stars, optional (evenb_S)  *)
(** One inconvenient aspect of our definition of [evenb n] is the
    recursive call on [n - 2]. This makes proofs about [evenb n]
    harder when done by induction on [n], since we may need an
    induction hypothesis about [n - 2]. The following lemma gives an
    alternative characterization of [evenb (S n)] that works better
    with induction: *)

Theorem evenb_S : forall n : nat,
  evenb (S n) = negb (evenb n).
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 1 star (destruct_induction)  *)
(** Briefly explain the difference between the tactics [destruct]
    and [induction].

(* FILL IN HERE *)
*)
(** [] *)

(* ################################################################# *)
(** * Proofs Within Proofs *)

(** In Coq, as in informal mathematics, large proofs are often
    broken into a sequence of theorems, with later proofs referring to
    earlier theorems.  But sometimes a proof will require some
    miscellaneous fact that is too trivial and of too little general
    interest to bother giving it its own top-level name.  In such
    cases, it is convenient to be able to simply state and prove the
    needed "sub-theorem" right at the point where it is used.  The
    [assert] tactic allows us to do this.  For example, our earlier
    proof of the [mult_0_plus] theorem referred to a previous theorem
    named [plus_O_n].  We could instead use [assert] to state and
    prove [plus_O_n] in-line: *)

Theorem mult_0_plus' : forall n m : nat,
  (0 + n) * m = n * m.
Proof.
  intros n m.
  assert (H: 0 + n = n). { reflexivity. }
  rewrite -> H.
  reflexivity.  Qed.

(** The [assert] tactic introduces two sub-goals.  The first is
    the assertion itself; by prefixing it with [H:] we name the
    assertion [H].  (We can also name the assertion with [as] just as
    we did above with [destruct] and [induction], i.e., [assert (0 + n
    = n) as H].)  Note that we surround the proof of this assertion
    with curly braces [{ ... }], both for readability and so that,
    when using Coq interactively, we can see more easily when we have
    finished this sub-proof.  The second goal is the same as the one
    at the point where we invoke [assert] except that, in the context,
    we now have the assumption [H] that [0 + n = n].  That is,
    [assert] generates one subgoal where we must prove the asserted
    fact and a second subgoal where we can use the asserted fact to
    make progress on whatever we were trying to prove in the first
    place. *)

(** Another example of [assert]... *)

(** For example, suppose we want to prove that [(n + m) + (p + q)
    = (m + n) + (p + q)]. The only difference between the two sides of
    the [=] is that the arguments [m] and [n] to the first inner [+]
    are swapped, so it seems we should be able to use the
    commutativity of addition ([plus_comm]) to rewrite one into the
    other.  However, the [rewrite] tactic is not very smart about
    _where_ it applies the rewrite.  There are three uses of [+] here,
    and it turns out that doing [rewrite -> plus_comm] will affect
    only the _outer_ one... *)

Theorem plus_rearrange_firsttry : forall n m p q : nat,
  (n + m) + (p + q) = (m + n) + (p + q).
Proof.
  intros n m p q.
  (* We just need to swap (n + m) for (m + n)... seems
     like plus_comm should do the trick! *)
  rewrite -> plus_comm.
  (* Doesn't work...Coq rewrote the wrong plus! *)
Abort.

(** To use [plus_comm] at the point where we need it, we can introduce
    a local lemma stating that [n + m = m + n] (for the particular [m]
    and [n] that we are talking about here), prove this lemma using
    [plus_comm], and then use it to do the desired rewrite. *)

Theorem plus_rearrange : forall n m p q : nat,
  (n + m) + (p + q) = (m + n) + (p + q).
Proof.
  intros n m p q.
  assert (H: n + m = m + n).
  { rewrite -> plus_comm. reflexivity. }
  rewrite -> H. reflexivity.  Qed.

(* ################################################################# *)
(** * Formal vs. Informal Proof *)

(** "_Informal proofs are algorithms; formal proofs are code_." *)

(** What constitutes a successful proof of a mathematical claim?
    The question has challenged philosophers for millennia, but a
    rough and ready definition could be this: A proof of a
    mathematical proposition [P] is a written (or spoken) text that
    instills in the reader or hearer the certainty that [P] is true --
    an unassailable argument for the truth of [P].  That is, a proof
    is an act of communication.

    Acts of communication may involve different sorts of readers.  On
    one hand, the "reader" can be a program like Coq, in which case
    the "belief" that is instilled is that [P] can be mechanically
    derived from a certain set of formal logical rules, and the proof
    is a recipe that guides the program in checking this fact.  Such
    recipes are _formal_ proofs.

    Alternatively, the reader can be a human being, in which case the
    proof will be written in English or some other natural language,
    and will thus necessarily be _informal_.  Here, the criteria for
    success are less clearly specified.  A "valid" proof is one that
    makes the reader believe [P].  But the same proof may be read by
    many different readers, some of whom may be convinced by a
    particular way of phrasing the argument, while others may not be.
    Some readers may be particularly pedantic, inexperienced, or just
    plain thick-headed; the only way to convince them will be to make
    the argument in painstaking detail.  But other readers, more
    familiar in the area, may find all this detail so overwhelming
    that they lose the overall thread; all they want is to be told the
    main ideas, since it is easier for them to fill in the details for
    themselves than to wade through a written presentation of them.
    Ultimately, there is no universal standard, because there is no
    single way of writing an informal proof that is guaranteed to
    convince every conceivable reader.

    In practice, however, mathematicians have developed a rich set of
    conventions and idioms for writing about complex mathematical
    objects that -- at least within a certain community -- make
    communication fairly reliable.  The conventions of this stylized
    form of communication give a fairly clear standard for judging
    proofs good or bad.

    Because we are using Coq in this course, we will be working
    heavily with formal proofs.  But this doesn't mean we can
    completely forget about informal ones!  Formal proofs are useful
    in many ways, but they are _not_ very efficient ways of
    communicating ideas between human beings. *)

(** For example, here is a proof that addition is associative: *)

Theorem plus_assoc' : forall n m p : nat,
  n + (m + p) = (n + m) + p.
Proof. intros n m p. induction n as [| n' IHn']. reflexivity.
  simpl. rewrite -> IHn'. reflexivity.  Qed.

(*
Sullivan: Pierce is using language loosely here. The script, made
up of tactics, that he calls a proof, is really just a proof-building
program. The actual proof term that this script builds is the proof
itself. You can see what it looks like using Print. And what you'll
find is that the proof term is actually some kind of function! It's not
important to understand the function at this point. But when you look
at that function, you're seeing the actual proof object that Coq type 
checks the proposition being proved (which, you recall, is a type).

Print plus_assoc'.

*)

(** Coq is perfectly happy with this.  For a human, however, it
    is difficult to make much sense of it.  We can use comments and
    bullets to show the structure a little more clearly... *)

Theorem plus_assoc'' : forall n m p : nat,
  n + (m + p) = (n + m) + p.
Proof.
  intros n m p. induction n as [| n' IHn'].
  - (* n = 0 *)
    reflexivity.
  - (* n = S n' *)
    simpl. rewrite -> IHn'. reflexivity.   Qed.

(** ... and if you're used to Coq you may be able to step
    through the tactics one after the other in your mind and imagine
    the state of the context and goal stack at each point, but if the
    proof were even a little bit more complicated this would be next
    to impossible.

    A (pedantic) mathematician might write the proof something like
    this: *)

(** - _Theorem_: For any [n], [m] and [p],

      n + (m + p) = (n + m) + p.

    _Proof_: By induction on [n].

    - First, suppose [n = 0].  We must show

        0 + (m + p) = (0 + m) + p.

      This follows directly from the definition of [+].

    - Next, suppose [n = S n'], where

        n' + (m + p) = (n' + m) + p.

      We must show

        (S n') + (m + p) = ((S n') + m) + p.

      By the definition of [+], this follows from

        S (n' + (m + p)) = S ((n' + m) + p),

      which is immediate from the induction hypothesis.  _Qed_. *)

(** The overall form of the proof is basically similar, and of
    course this is no accident: Coq has been designed so that its
    [induction] tactic generates the same sub-goals, in the same
    order, as the bullet points that a mathematician would write.  But
    there are significant differences of detail: the formal proof is
    much more explicit in some ways (e.g., the use of [reflexivity])
    but much less explicit in others (in particular, the "proof state"
    at any given point in the Coq proof is completely implicit,
    whereas the informal proof reminds the reader several times where
    things stand). *)

(** **** Exercise: 2 stars, advanced, recommended (plus_comm_informal)  *)
(** Translate your solution for [plus_comm] into an informal proof:

    Theorem: Addition is commutative.

    Proof: (* FILL IN HERE *)
*)
(** [] *)

(** **** Exercise: 2 stars, optional (beq_nat_refl_informal)  *)
(** Write an informal proof of the following theorem, using the
    informal proof of [plus_assoc] as a model.  Don't just
    paraphrase the Coq tactics into English!

    Theorem: [true = beq_nat n n] for any [n].

    Proof: (* FILL IN HERE *)
[] *)

(* ################################################################# *)
(** * More Exercises *)

(** **** Exercise: 3 stars, recommended (mult_comm)  *)
(** Use [assert] to help prove this theorem.  You shouldn't need to
    use induction on [plus_swap]. *)

Theorem plus_swap : forall n m p : nat,
  n + (m + p) = m + (n + p).
Proof.
  (* FILL IN HERE *) Admitted.

(** Now prove commutativity of multiplication.  (You will probably
    need to define and prove a separate subsidiary theorem to be used
    in the proof of this one.  You may find that [plus_swap] comes in
    handy.) *)

Theorem mult_comm : forall m n : nat,
  m * n = n * m.
Proof.
Show Proof.
intros.
Show Proof.
induction m.
Show Proof.
simpl.
Show Proof.
SearchAbout mult.
rewrite<-mult_n_O.
reflexivity.
simpl.
assert (H1: forall j k: nat, j + j *  k = j * S k).
induction j. intro. simpl. reflexivity.
intro. simpl. rewrite->plus_swap. rewrite->IHj. reflexivity.
rewrite<-H1. rewrite->IHm. reflexivity.
Show Proof.
Qed.

(** [] *)

(** **** Exercise: 3 stars, optional (more_exercises)  *)
(** Take a piece of paper.  For each of the following theorems, first
    _think_ about whether (a) it can be proved using only
    simplification and rewriting, (b) it also requires case
    analysis ([destruct]), or (c) it also requires induction.  Write
    down your prediction.  Then fill in the proof.  (There is no need
    to turn in your piece of paper; this is just to encourage you to
    reflect before you hack!) *)

Check leb.

Theorem leb_refl : forall n:nat,
  true = leb n n.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem zero_nbeq_S : forall n:nat,
  beq_nat 0 (S n) = false.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem andb_false_r : forall b : bool,
  andb b false = false.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem plus_ble_compat_l : forall n m p : nat,
  leb n m = true -> leb (p + n) (p + m) = true.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem S_nbeq_0 : forall n:nat,
  beq_nat (S n) 0 = false.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem mult_1_l : forall n:nat, 1 * n = n.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem all3_spec : forall b c : bool,
    orb
      (andb b c)
      (orb (negb b)
               (negb c))
  = true.
Proof.
  (* FILL IN HERE *) Admitted.

Theorem mult_plus_distr_r : forall n m p : nat,
  (n + m) * p = (n * p) + (m * p).
Proof.
  (* FILL IN HERE *) Admitted.

Theorem mult_assoc : forall n m p : nat,
  n * (m * p) = (n * m) * p.
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 2 stars, optional (beq_nat_refl)  *)
(** Prove the following theorem.  (Putting the [true] on the left-hand
    side of the equality may look odd, but this is how the theorem is
    stated in the Coq standard library, so we follow suit.  Rewriting
    works equally well in either direction, so we will have no problem
    using the theorem no matter which way we state it.) *)

Theorem beq_nat_refl : forall n : nat,
  true = beq_nat n n.
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 2 stars, optional (plus_swap')  *)
(** The [replace] tactic allows you to specify a particular subterm to
   rewrite and what you want it rewritten to: [replace (t) with (u)]
   replaces (all copies of) expression [t] in the goal by expression
   [u], and generates [t = u] as an additional subgoal. This is often
   useful when a plain [rewrite] acts on the wrong part of the goal.

   Use the [replace] tactic to do a proof of [plus_swap'], just like
   [plus_swap] but without needing [assert (n + m = m + n)]. *)

Theorem plus_swap' : forall n m p : nat,
  n + (m + p) = m + (n + p).
Proof.
  (* FILL IN HERE *) Admitted.
(** [] *)

(** **** Exercise: 3 stars, recommended (binary_commute)  *)
(** Recall the [incr] and [bin_to_nat] functions that you
    wrote for the [binary] exercise in the [Basics] chapter.  Prove
    that the following diagram commutes:

                            incr
              bin ----------------------> bin
               |                           |
    bin_to_nat |                           |  bin_to_nat
               |                           |
               v                           v
              nat ----------------------> nat
                             S

    That is, incrementing a binary number and then converting it to
    a (unary) natural number yields the same result as first converting
    it to a natural number and then incrementing.
    Name your theorem [bin_to_nat_pres_incr] ("pres" for "preserves").

    Before you start working on this exercise, copy the definitions
    from your solution to the [binary] exercise here so that this file
    can be graded on its own.  If you want to change your original
    definitions to make the property easier to prove, feel free to
    do so! *)

(* FILL IN HERE *)
(** [] *)

(** **** Exercise: 5 stars, advanced (binary_inverse)  *)
(** This exercise is a continuation of the previous exercise about
    binary numbers.  You will need your definitions and theorems from
    there to complete this one; please copy them to this file to make
    it self contained for grading.

    (a) First, write a function to convert natural numbers to binary
        numbers.  Then prove that starting with any natural number,
        converting to binary, then converting back yields the same
        natural number you started with.

    (b) You might naturally think that we should also prove the
        opposite direction: that starting with a binary number,
        converting to a natural, and then back to binary yields the
        same number we started with.  However, this is not true!
        Explain what the problem is.

    (c) Define a "direct" normalization function -- i.e., a function
        [normalize] from binary numbers to binary numbers such that,
        for any binary number b, converting to a natural and then back
        to binary yields [(normalize b)].  Prove it.  (Warning: This
        part is tricky!)

    Again, feel free to change your earlier definitions if this helps
    here. *)

(* FILL IN HERE *)
(** [] *)

(* 
Sullivan: Now prove the sumto theorem! You'll probably have
to use properties of the arithmetic functions plus and perhaps
times.
*)

Theorem quad': forall n: nat, (sumto n) * 2 = (S n) * n.
Proof. (* by induction *)
induction n.
(* base case *)
reflexivity.
(* inductive case *)
(* lemma *)
assert (decomp_sum: forall k, sumto (S k) = (S k) + (sumto k)).
induction k.
reflexivity.
simpl.
reflexivity.
(* end lemma *)
rewrite->decomp_sum.
rewrite->mult_plus_distr_r.
simpl.
SearchAbout plus.
rewrite<-plus_n_Sm.
rewrite->IHn.
rewrite->plus_assoc.
SearchAbout mult.
rewrite<-mult_n_Sm.
(* lemma, right mult identity *)
assert (mult_id_r: forall k, k * 1 = k).
induction k.
reflexivity.
simpl.
rewrite IHk.
reflexivity.
(* end lemma *)
rewrite->mult_id_r.
simpl.
SearchAbout mult.
rewrite<-mult_n_Sm.
(* lemma, plus commutes with product *)
assert (plus_comm_prod: forall k, k + k * k = k * k + k).
intros.
rewrite->plus_comm.
reflexivity.
(* end lemma *)
rewrite->plus_comm_prod.
reflexivity.
Qed.

(** $Date: 2017-08-22 17:13:32 -0400 (Tue, 22 Aug 2017) $ *)
