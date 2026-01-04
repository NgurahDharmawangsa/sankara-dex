<?php
namespace App\Helpers;

class Invoice {

    public static function checkRemainingInvoice($userId, $invoiceId, $type = null)
    {
        $invoice = \App\Models\Invoice::when($type != "", function($query) use ($type) {
            $query->where('type', $type);
        })->where('id', $invoiceId)->first();

        $payments = \App\Models\Transaction::where('student->id', $userId)
            ->where('invoice->id', $invoiceId)->orderBy('created_at', 'asc')
            ->where('status', 'APPROVE')
            ->get();

        $totalPayment = 0;
        foreach ($payments as $payment) {
            if($payment->status == "APPROVE") {
                $totalPayment += $payment->amount;
            }
        }

        return (@$invoice->amount ?? 0) - $totalPayment;
    }

    public static function getAllInvoice($month, $year, $withRemining = false)
    {
        $invoices = \App\Models\Invoice::with(['users' => function($query) use ($month, $year) {
            $query->whereMonth('invoice_user.created_at', $month)->whereYear('invoice_user.created_at', $year);
        }])->whereHas('users', function($query) use ($month, $year) {
            $query->whereMonth('invoice_user.created_at', $month)->whereYear('invoice_user.created_at', $year);
        })->get();

        $totalPayment = 0;
        if($withRemining) {
            $totalPayment = \App\Models\Transaction::orderBy('created_at', 'asc')
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 'APPROVE')
                ->sum('amount');
        }

        $total = 0;
        foreach ($invoices as $invoice) {
            foreach ($invoice->users as $user) {
                $total += $invoice->amount;
            }
        }

        $data['invoice'] = $total;
        $data['remaining_invoice'] = $total - $totalPayment;

        return $data;
    }

    public static function getTransactionPayment($date)
    {
        return \App\Models\Transaction::orderBy('created_at', 'asc')
            ->where('date', $date)
            ->where('status', 'APPROVE')
            ->sum('amount');
    }

}
