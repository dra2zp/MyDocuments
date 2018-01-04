(* Exam 2 MAKEUP *)

(** Denny Anderson
    dra2zp
    12/15/2017
    CS 6501 -- Software Logic
    Exam 2 Makeup             *)

(*

#1A: A natural number, n > 1, is said to be "prime" if there
does not exist a natural number, h, h > 1 /\ h < n, such that
there does exist a natural number k, k > 1 /\ k < n, such that
n = h * k. First, specify the prime *property* of natural numbers 
in Coq. In other words, translate the definition above precisely
into a corresponding property in Coq. 
*)

Require Import Coq.Bool.Bool.
Require Import Coq.Arith.Arith.
Require Import Coq.Arith.EqNat.
Require Import Coq.omega.Omega.
From LF Require Import Logic Maps Imp.

Inductive prime : nat -> Prop :=
  factors: forall n : nat,
  ((*~*) exists h : nat, h > 1 /\ h < n ->
  (exists k : nat, k > 1 /\ k < n /\ n = h * k)) ->
  prime n.



(* #1B: Now write and then prove a theorem that 3 is 
prime.
*)

Theorem threeIsPrime: prime 3.
Proof. apply factors. exists 2. exists 2. split.
  - destruct H. apply H.
  - destruct H. split.
    + apply H0.
    + simpl. Admitted.




(*
#2: We represent logical conjunction of propositions in Coq as
a propositional type polymorphic in two smaller propositions, with
constructor. Given a proof for each of the two propositions, the
constructor builds a proof of the conjuction. The proof is basically
a pair with the two smaller proofs as elements. Your task here is
to implement a "generalized conjunction" type, called [genand L]. 
It's like [and A B], but instead of taking just two propositions as 
arguments, it takes a list of propositions as arguments. It should 
have as many constructors as necessary, but no more, so that 
a proof can be constructed if and only if all propositions in the list
are true. 
*)

(* You might need the following two lines to use the [] notation. *)
Require Import Coq.Lists.List.
Import ListNotations.




(*
#3 Our Arithmetic and Boolean expression languages supports variables 
that states map values of type [nat]. Extend these languages and their
evaluators to support Boolean-valued variables. Define a new type of 
variables that will take on Boolean values, rename [state] to [natstate], 
add a new type of variables that will map to Boolean values and add a
separate [boolstate] function to assign values to these variables. Make
all other changes as necessary, including the passing of both nat and 
bool state functions to the evaluators. Provide a few test cases to show
that your extended design works as intended. Copy and paste all of the
necessary code from the book to here and then make your extensions
and modifications to that code.
*)