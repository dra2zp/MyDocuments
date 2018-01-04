(* FINAL EXAM, FALL 2017 *)

(** Denny Anderson
    dra2zp
    12/15/2017
    CS 6501 -- Software Logic
    Final Exam                *)

(*
#1. Consider the following one-line program.

[Fixpoint nope (n: nat): False := nope n.]

The program takes a nat, and calls itself recursively.
Coq will not accept this program. In a short sentence of
two, explain why Coq  *must* reject such programs.

Answer here:

The nope recursive function above takes in an n of type nat
and calls the function again using the same parameter n. Coq
must reject programs like this because it results in an
infinite loop, which does not terminate and could potentially
provide a proof of false.

*)



(* 
#2: 
The fact that pure functional programs have no side
effects makes them much easier to reason about than
programs written in imperative languages, even when 
these programs compute exactly the same function. 

One consequence is that we will often write a specification
of an imperative program in part by writing a program in a
functional style that computes exactly the function that we
want an imperative program to implement. We will then 
prove that the functional program has desired properties.
Next we will use  the functional implementation in writing
the specification for the imperative program. We will then
write the imperative program and show that it is equivalent 
to the functional program. In this way we produce normal 
imperative code that is proven to have the property that we
care about. The rest of the exam asks you to show that you
can go through this process on your own.
*)



(*
#1. Implement a function, [sumup (n: nat): nat] that returns 
the sum of the natural numbers from 1 to n inclusive. It must
work by simply adding up these numbers using a recursion.
*)

Fixpoint sumup (n: nat): nat :=
  match n with
  | 0 => 0
  | S k => n + sumup k
  end.



(*
#2: The sum of the natural numbers from zero  to n can 
be expressed as "Sum i, i in 0..n = n (n + 1) / 2." Prove 
that for any n, your program returns n * (n + 1) / 2. Hint:
Given that we don't have a division operator, you can
multiply each side by two: [forall n, (sumup n) * 2 = ...]. 
*)

Lemma plus_n_0 : forall n : nat, n + 0 = n.
Proof. intro n. induction n.
  - simpl. reflexivity.
  - simpl. rewrite IHn. reflexivity.
Qed.

Lemma plus_n_Sm : forall n m : nat, S (n + m) = n + (S m).
Proof. intros n m. induction n as [| n' IHn'].
  - simpl. reflexivity.
  - simpl. rewrite IHn'. reflexivity.
Qed.

Lemma help1 : forall n : nat, S n + sumup n = S (n + sumup n).
Proof. intro n. induction n.
  - simpl. reflexivity.
  - simpl. reflexivity.
Qed.

Lemma plus_comm : forall n m : nat, n + m = m + n.
Proof. intros n m. induction n as [| n' IHn'].
  - simpl. rewrite plus_n_0. reflexivity.
  - rewrite <- plus_n_Sm. rewrite <- IHn'. reflexivity.
Qed.

Lemma plus_assoc : forall n m p : nat,
  n + (m + p) = (n + m) + p.
Proof. intros n m p. induction n as [| n' IHn'].
  - simpl. reflexivity.
  - simpl. rewrite -> IHn'. reflexivity.
Qed.

Lemma help2 : forall n : nat,
  S n + sumup n + n = n + S n + sumup n.
Proof. intro n. rewrite plus_comm. rewrite plus_assoc.
  reflexivity. Qed.

Lemma help3 : forall n : nat,
  2 * sumup (S n) = 2 * S n + 2 * sumup n.
Proof. intro n. simpl. rewrite plus_n_0. rewrite plus_n_0.
  rewrite plus_n_0. rewrite <- help1. rewrite plus_comm.
  rewrite plus_assoc. rewrite plus_assoc. rewrite help2.
  reflexivity. Qed.

Lemma help4 : forall n : nat, n + S n = S n + n.
Proof. intro n. rewrite plus_comm. reflexivity. Qed.

Lemma help5 : forall n : nat,
  n + sumup n + S n = n + S n + sumup n.
Proof. intro n. rewrite plus_comm. rewrite plus_assoc.
  rewrite help4. reflexivity. Qed.

Lemma help6 : forall n : nat,
  n + S n + sumup n + sumup n = n + S n + 2 * sumup n.
Proof. intro n. induction n.
  - simpl. reflexivity.
  - simpl. rewrite plus_n_0. rewrite <- plus_assoc.
    reflexivity.
Qed.

Lemma help7 : forall n : nat,
  S (n + n * S (S n)) = S n + n * S (S n).
Proof. intro n. induction n.
  - simpl. reflexivity.
  - simpl. reflexivity.
Qed.

Lemma mult_plus_distr_r : forall n m p : nat,
  (n + m) * p = (n * p) + (m * p).
Proof.
  intros n m p. induction n.
  - simpl. reflexivity.
  - simpl. rewrite IHn. rewrite plus_assoc. reflexivity.
Qed.

Lemma help8 : forall n k: nat, n * S (S k) = n * S k + n.
Proof. intros n k. induction n.
  - simpl. reflexivity.
  - simpl. rewrite <- plus_n_Sm. rewrite IHn.
    rewrite plus_assoc. reflexivity.
Qed.

Lemma help9 : forall n : nat, n * S n + S n = S n + n * S n.
Proof. intro n. rewrite plus_comm. reflexivity. Qed.

Theorem sumFormula : forall n : nat,
  2 * sumup n = n * S n.
Proof. intro n. induction n.
  - simpl. reflexivity.
  - simpl. rewrite plus_n_0. rewrite <- help1.
    rewrite plus_assoc. rewrite help5. rewrite help6.
    rewrite plus_comm. rewrite IHn. rewrite plus_comm.
    rewrite help4. rewrite help7. rewrite help8.
    rewrite plus_assoc. rewrite plus_comm. rewrite plus_assoc.
    rewrite help9. reflexivity.
Qed.



Require Import Coq.Bool.Bool.
Require Import Coq.Arith.Arith.
Require Import Coq.Arith.EqNat.
Require Import Coq.omega.Omega.
From LF Require Import Maps Imp.

(*
#3: Write an [Imp] program, sumit, that computes the
sum of all of the natural numbers from zero to n. The
value, n, should be assigned to the variable N at the
start of program execution and the variable S should 
be initially set to zero. When the program terminates,
the value of S should be the required sum. You may
use other variables in your implementation if needed.
*)

Definition sumit : com :=
  Y ::= ANum 0;;
  Z ::= AId X;;
  WHILE BNot (BEq (ANum 0) (AId Z)) DO
    Y ::= APlus (AId Y) (AId Z);;
    Z ::= AMinus (AId Z) (ANum 1)
  END.



(*
#4. Write an prove Hoare triple stating that if your program
is started in a state where S is zero, that when it is finished
S will be equal to [sumup n]. Here you see what we stated:
the use of a functional program about which you proved a
theorem appearing in the *specification* of an imperative
program. You will have thereby shown that your imperative
program has the *formally* specified correctness property.
This is what it means to produce code that is certified to 
be correct.
*)

Definition Assertion := state -> Prop.

Definition assert_implies (P Q : Assertion) : Prop :=
  forall st, P st -> Q st.

Notation "P ->> Q" := (assert_implies P Q) (at level 80).

Notation "P <<->> Q" := (P ->> Q /\ Q ->> P) (at level 80).

Definition hoare_triple
  (P:Assertion) (c:com) (Q:Assertion) : Prop := forall st st',
  c / st \\ st'  -> P st  -> Q st'.

Notation "{{ P }}  c  {{ Q }}" :=
  (hoare_triple P c Q) (at level 90, c at next level).

Lemma hoare_post_true : forall (P Q : Assertion) c,
  (forall st, Q st) -> {{P}} c {{Q}}.
Proof. intros P Q c H. unfold hoare_triple.
  intros st st' Heval HP. apply H. Qed.

Lemma hoare_pre_false : forall (P Q : Assertion) c,
  (forall st, ~(P st)) -> {{P}} c {{Q}}.
Proof. intros P Q c H. unfold hoare_triple.
  intros st st' Heval HP. unfold not in H. apply H in HP.
  inversion HP. Qed.

Definition assn_sub X a P : Assertion :=
  fun (st : state) => P (t_update st X (aeval st a)).

Notation "P [ X |-> a ]" := (assn_sub X a P) (at level 10).

Lemma hoare_asgn : forall Q X a,
  {{Q [X |-> a]}} (X ::= a) {{Q}}.
Proof. unfold hoare_triple. intros Q X a st st' HE HQ.
  inversion HE. subst. unfold assn_sub in HQ. assumption. Qed.

Lemma hoare_consequence_pre : forall (P P' Q : Assertion) c,
  {{P'}} c {{Q}} -> P ->> P' -> {{P}} c {{Q}}.
Proof. intros P P' Q c Hhoare Himp. intros st st' Hc HP.
  apply (Hhoare st st'). assumption. apply Himp. assumption.
  Qed.

Lemma hoare_consequence_post : forall (P Q Q' : Assertion) c,
  {{P}} c {{Q'}} -> Q' ->> Q -> {{P}} c {{Q}}.
Proof. intros P Q Q' c Hhoare Himp. intros st st' Hc HP.
  apply Himp. apply (Hhoare st st'). assumption. assumption.
  Qed.

Lemma hoare_skip : forall P, {{P}} SKIP {{P}}.
Proof. intros P st st' H HP. inversion H. subst. assumption.
  Qed.

Lemma hoare_seq : forall P Q R c1 c2,
  {{Q}} c2 {{R}} -> {{P}} c1 {{Q}} -> {{P}} c1;;c2 {{R}}.
Proof. intros P Q R c1 c2 H1 H2 st st' H12 Pre. inversion H12;
  subst. apply (H1 st'0 st'); try assumption.
  apply (H2 st st'0); assumption. Qed.

Definition bassn b : Assertion :=
  fun st => (beval st b = true).

Lemma bexp_eval_true : forall b st,
  beval st b = true -> (bassn b) st.
Proof. intros b st Hbe. unfold bassn. assumption. Qed.

Lemma bexp_eval_false : forall b st,
  beval st b = false -> ~ ((bassn b) st).
Proof. intros b st Hbe contra. unfold bassn in contra.
  rewrite -> contra in Hbe. inversion Hbe. Qed.

Lemma hoare_while : forall P b c,
  {{fun st => P st /\ bassn b st}} c {{P}} ->
  {{P}} WHILE b DO c END {{fun st => P st /\ ~ (bassn b st)}}.
Proof. intros P b c Hhoare st st' He HP.
  remember (WHILE b DO c END) as wcom eqn:Heqwcom.
  induction He; try (inversion Heqwcom); subst; clear Heqwcom.
  - split. assumption. apply bexp_eval_false. assumption.
  - apply IHHe2. reflexivity. apply (Hhoare st st').
    assumption. split. assumption. apply bexp_eval_true.
    assumption.
Qed.

Theorem sumupHoareTriple : forall (X : nat),
  {{fun st => st Y = 0}} (sumit) {{fun st => st Y = sumup X}}.
Proof. eapply hoare_consequence_pre.
  eapply hoare_consequence_post. apply hoare_asgn. intros st H.
  apply H. intros st H. apply H. Admitted.
