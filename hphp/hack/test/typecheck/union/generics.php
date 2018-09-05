<?hh // strict

class A<T> {
  const type Ta = ?int;
  abstract const type Tabs;
  abstract const type Tcstr as int;

  public function isAClass(): bool {
    return true;
  }

  public function isSomethingWithT(T $x): bool {
    return true;
  }

  public function f(bool $cond, Ta $a, Tabs $abs, Tcstr $cstr): void {
    $x = ($cond ? 0 : $a);
    hh_show($x);

    $x = ($cond ? $abs : $a);
    hh_show($x);

    $x = ($cond ? $cstr : 0);
    hh_show($x);

    $x = ($cond ? $cstr : $a);
    hh_show($x);
  }
}

class B<T> {
  public function __construct(T $x) {}

  public function isAClass(): bool {
    return true;
  }
}

class C {}

function f<T, Tu super C, Tv as C, Tw super C, Ty as C>(
  bool $b,
  A<int> $aint,
  A<int> $aint2,
  A<T> $at,
  A<T> $at2,
  Tu $u,
  Tv $v,
  Tw $w,
  Ty $y,
  C $c,
): void {
  $x = ($b ? new A<int>() : new A<int>());
  hh_show($x);

  $x = ($b ? new A() : new A());
  hh_show($x);

  $x = ($b ? new A() : new A<int>());
  hh_show($x);

  $x = ($b ? new B<int>(0) : new B<int>(0));
  hh_show($x);

  $x = ($b ? new B(0) : new B(0));
  hh_show($x);

  $x = ($b ? $aint : new A<int>());
  hh_show($x);

  $x = ($b ? $aint : new A());
  hh_show($x);

  $x = ($b ? $at : new A());
  hh_show($x);

  $x = ($b ? $at : new A<int>());
  hh_show($x);

  $x = ($b ? $at : $aint);
  hh_show($x);

  $x = ($b ? $at : $at2);
  hh_show($x);

  $x = ($b ? new A<int>() : new A<string>());
  hh_show($x);
  hh_show($x->isSomethingWithT("")); // error

  $x = ($b ? new A<num>() : new A<arraykey>());
  hh_show($x);
  hh_show($x->isSomethingWithT(0));

  $x = ($b ? new A<int>() : new B(0));
  hh_show($x);
  hh_show($x->isAClass());

  $x = ($b ? $u : $c);
  hh_show($x);

  $x = ($b ? $v : $c);
  hh_show($x);

  $x = ($b ? $u : $v);
  hh_show($x);

  $x = ($b ? $u : $w);
  hh_show($x);

  $x = ($b ? $v : $y);
  hh_show($x);
}
