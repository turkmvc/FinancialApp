<?php

namespace Tests\Feature\Transaction;

use Carbon\Carbon;
use App\Model\User;
use Tests\TestCase;
use App\Model\Category;
use App\Model\BankAccount;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepeatedTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionDaily()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Daily'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50.00,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addDay(1)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addDay(2)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionWeekly()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Weekly'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addWeek(1)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addWeek(2)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionBiweekly()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Biweekly'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addWeek(2)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addWeek(4)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionMonthly()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Monthly'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(1)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(2)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionQuarterly()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Quarterly'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(3)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(6)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionSemiannually()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Semiannually'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(6)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addMonth(12)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }

    /**
     * @test
     */
    public function aUserCanCreateARepeatedTransactionAnnually()
    {
        $this->actingAs(factory(User::class)->create(), 'api');
        factory(Category::class)->create();
        factory(BankAccount::class)->create();

        $transaction = [
            'description' => 'Transaction',
            'amount' => 50,
            'type' => 'Expense',
            'due_at' => Carbon::now()->toDateString(),
            'category_id' => 1,
            'account_id' => 1,
            'payed' => true,

            'repeat' => true,
            'repeatTimes' => 3,
            'period' => 'Annually'
        ];

        //POST
        $request = $this->post('/api/transactions', $transaction);

        $request->assertCreated()
            ->assertJson([
                [
                    'id' => 1,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => true,
                    'first_transaction' => 1
                ],
                [
                    'id' => 2,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addYear(1)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
                [
                    'id' => 3,
                    'description' => 'Transaction',
                    'amount' => 50,
                    'type' => 'Expense',
                    'due_at' => Carbon::now()->addYear(2)->toDateString(),
                    'category_id' => 1,
                    'account_id' => 1,
                    'payed' => false,
                    'first_transaction' => 1
                ],
            ]);
    }
}