(* Exam 2 *)

(** Denny Anderson
    dra2zp
    exam2.v        *)

(*

#1A: A natural number, n > 1, is said to be "composite" if there
exists natural numbers, h and k, h > 1 /\ h < n, k > 1 /\ k < n, 
such that n is equal to h * k. First, specify the "composite" 
*property* of natural numbers in Coq. Your inductive family 
of propositions (that's a hint) will need one proof constructor. 
Call it [factors]. 
*)

(*
Inductive composite: nat -> Prop :=
  factors: forall n: nat,
    n > 1 ->
    (exists h k: nat,
      h > 1 /\ k > 1 /\ n = h * k) ->
    composite n.
*)

(*
Inductive composite : nat -> Prop :=
  | factors : forall n : nat, exists (h : nat) (k : nat),
    composite n -> n = h * k.
*)

Inductive composite : nat -> Prop :=
  | factors : forall n : nat, composite n -> composite (S (S n)).

(* #1B: Now write and then prove a theorem stating that 4 is composite. 
As a hint, recall that > is just a notation for a function.
*)

(*
Theorem fourIsComposite: composite 4.
Proof. apply factors. unfold gt. unfold lt. apply le_S. apply le_n.
  exists 2. exists 2. split. unfold gt. unfold lt. apply le_n. split.
  unfold gt. unfold lt. apply le_n. reflexivity.
Qed.

Theorem four_is_composite: composite 4.
Proof. apply factors. apply factors. Admitted.

(*
#2: We formalize ordinary logical conjunction in Coq as a type,
constructor, [and], polymorphic in two ("smaller") conjuctions,
with a proof constructor, [conj], that when given a proof of [P]
and a proof of [Q] constructs and returns a proof of [and P Q] 

In some legal situations, one requires only a "preponderance"
of evidence to justify a conclusion. Your assignment here is to
define a new operator, we'll call it [prepand], that takes three
propositions, let's call them [P], [Q], and [R], that we will define 
to be true if one has proofs for at least two of the three given 
propositions. Write a Coq specification of [prepond]. Hint: You
can model your answer to some extend on the definition of the
[and] operator in the Curry-Howard Correspondence chapter of
the book.

Then write and prove the proposition, call it [notprep], stating 
that it is *not* the case that [prepand 0=1 true=false []=[1]] is 
true.
*)

(* You will need the following two lines to use the [] notation. *)
Require Import Coq.Lists.List.
Import ListNotations.

Inductive prepond (P Q R : Prop) : Prop :=
  | proofPQ : P -> Q -> prepond P Q R
  | proofQR : Q -> R -> prepond P Q R
  | proofPR : P -> R -> prepond P Q R.

Example notprep : ~ (prepond (0 = 1) (true = false) ([] = [1])).
Proof. unfold not. Admitted.

(*
#3: In a precise but informal sentence, state what the axiom 
of "functional extensionality" asserts. Write your answer in 
terms of two functions, f and g, each from some type, A, to 
some type B. Write your answer within this comment block:

ANSWER: 
Functional extensionality means that that a function is identified and
defined by what it outputs for a given input. Forall inputs x of some
type, f x = g x -> f = g. This is saying that if f applied to x is equal
to g applied to x for all inputs x, then f and g are the same function
because they produce identical outputs.
*)

(*
#4: In a precise but informal sentence, state what it 
means for a relation to be a function? You can write your answer
in terms of a function, f, from some type, A, to some type B. 

ANSWER: 
A function f, from some type A to some type B, applied to inputs a (of
type A) and b (of type B) results in a proposition that asserts that
the pair (a, b) is in the relation, thus aRb.
*)

(*
#5: In a precise but informal sentence, state what it
means a function to be injective. You can write your answer in
terms of a function, f, from some type, A, to some type B. 

ANSWER: 
A function f is injective if and only if forall a1 and a2 (of type A)
and forall b1 and b2 (of type B), if f a1 = b1 and f a2 = b2, then
a1 = a2 implies that b1 = b2.
*)

(*
#6: In precise informal language, what does the induction 
principle for the type, [list A], say? Keep your answer short.

ANSWER: 
The induction principle says that for the type list A,
forall (A : Type) (P : list A -> Prop),
  P (nil A) ->
  (forall (a : A) (l : list A), P l -> P (cons A a l)) ->
  forall l : list A, P l.
*)

(*
#7: Some languages allow you to assign values to more than
one variable at a time. Here you will build a little system that
will let you do this using total maps as a representation of a
simple "environment" (a mapping from variables to values).
*)

(*
Define a type, [var], with three constructors, [X, Y, Z]. 
These will be your "variables." 
*)

Inductive var : Type :=
  | X : var
  | Y : var
  | Z : var.

(*
Define a function, [eq_var], that takes two variables and 
return [true] if they're the same and [false] otherwise.
*)

Definition eq_var (v1 : var) (v2 : var) : bool :=
  match v1 with
  | X => match v2 with
    | X => true
    | _ => false
    end
  | Y => match v2 with
    | Y => true
    | _ => false
    end
  | Z => match v2 with
    | Z => true
    | _ => false
    end
end.


(*
Define [env] to be the type, [var -> nat]. You will model a given
environment (mapping from variables to nat values) as a value
of this function type.
*)

Definition env : var -> nat.

(*
Define [init] to be the value of type [env] that maps every
variable to zero. Use [fun] notation.
*)

(*
Now define a function, [override2], that takes two variables,
two nats, and and environment (of type [env]) and that returns 
an environment  in which the given variables have the given 
values and no other changes occur. 
*)

(*
Assign to [nEnv] the result of overriding the [init] environment
with an assignment of 1 to X and 2 to Y.
*)

(*
Finally prove that the result is correct by uncommenting and 
proving this test case.

Example or2Works: nEnv X = 1 /\ nEnv Y = 2 /\ nEnv Z = 0.
*)

(*
EXTRA CREDIT BELOW!
*)

(*
#EC_A: Define the syntax of a simple expression language
as an inductive data type, [sExp]. The language has just 
two expressions: "Const n", where n is a nat, and "Square s", 
where s is an sExp.
*)

(*
#EC_B: Define an operational semantics, [sEval], for [sExp], as 
follows. An [sExp] evaluates to a [nat]  as follows. [Const n] 
evalautes to [n], and [Square s] evaluates to the square of the 
value of [s].
*)

(*
#EC_C: Prove a theorem called [itworks] asserting that the 
expression in which Square is applied twice to Const 3 
equals 81.
*)

(*
#EC_D: Write a semantics, call it [sEvalR], for [sExp] as a 
relation and prove the same test case (call it [itworksR]), but 
using the inference rules of  your semantics. Hint: Assert a 
little lemma that will let you rewrite 81 into the form required 
to unify. 
*)