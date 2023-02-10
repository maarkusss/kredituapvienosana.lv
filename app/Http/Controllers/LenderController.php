<?php

namespace App\Http\Controllers;

use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Settings;
use App\Services\LenderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LenderController extends Controller
{
    /**
     * List All Lenders
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $lender_arr = LenderService::getAll();

        return response()->json($lender_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $name
     * @return JsonResponse
     */
    public function update(Request $request, string $name): JsonResponse
    {
        $api_key = $request->header('apikey');
        $settings = Settings::where('name', 'api_key')->where('value', $api_key)->exists();

        if ($settings) {
            $lender = Lenders::where('name', 'LIKE', '%' . $name . '%')->first();

            if ($lender) {
                if ($request->first_loan) {
                    $lender->update([
                        'first_loan' => $request->first_loan,
                    ]);
                }

                if ($request->min_amount) {
                    $lender->update([
                        'min_amount' => $request->min_amount,
                    ]);
                }

                if ($request->max_amount) {
                    $lender->update([
                        'max_amount' => $request->max_amount,
                    ]);
                }

                if ($request->min_term) {
                    $lender->update([
                        'min_term' => $request->min_term,
                    ]);
                }

                if ($request->max_term) {
                    $lender->update([
                        'max_term' => $request->max_term,
                    ]);
                }

                if ($request->receiving_time) {
                    $lender->update([
                        'receiving_time' => $request->receiving_time,
                    ]);
                }

                if ($request->min_years) {
                    $lender->update([
                        'min_years' => $request->min_years,
                    ]);
                }

                if ($request->max_years) {
                    $lender->update([
                        'max_years' => $request->max_years,
                    ]);
                }

                if ($request->daily_epc) {
                    $lender->update([
                        'daily_epc' => $request->daily_epc,
                    ]);
                }

                $lender->update([
                    'active' => ($request->active ? $request->active : 0),
                    'zero_percent' => ($request->zero_percent ? $request->zero_percent : 0),
                    'guaranteed_epc' => ($request->guaranteed_epc ? $request->guaranteed_epc : null),
                    'frequency' => ($request->frequency ? $request->frequency : null),
                ]);

                if ($request->image) {
                    $image = Image::make($request->image)->encode('png');

                    $hash = md5($image->__toString());
                    $path = "storage/logos/{$hash}.png";
                    $image->save(public_path($path));

                    $lender->update([
                        'image' => '/' . $path,
                    ]);
                }

                if ($request->slogan) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'slogan' => $request->slogan,
                        ]);
                    }
                }

                if ($request->slogan2) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'slogan' => $request->slogan2,
                        ]);
                    }
                }

                if ($request->company_name) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'company_name' => $request->company_name,
                        ]);
                    }
                }

                if ($request->company_name2) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'company_name' => $request->company_name2,
                        ]);
                    }
                }

                if ($request->address) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'address' => $request->address,
                        ]);
                    }
                }

                if ($request->address2) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'address' => $request->address2,
                        ]);
                    }
                }

                if ($request->phone) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'phone' => $request->phone,
                        ]);

                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'phone' => $request->phone,
                        ]);
                    }
                }

                if ($request->email) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'email' => $request->email,
                        ]);

                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'email' => $request->email,
                        ]);
                    }
                }

                if ($request->max_apr) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'max_apr' => $request->max_apr,
                        ]);

                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'max_apr' => $request->max_apr,
                        ]);
                    }
                }

                if ($request->apr_example) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan_lng)->where('lender_id', $lender->id)->update([
                            'apr_example' => $request->apr_example,
                        ]);
                    }
                }

                if ($request->apr_example2) {
                    if ($lender->dataAPI) {
                        $lender->dataAPI->where('lang', $request->slogan2_lng)->where('lender_id', $lender->id)->update([
                            'apr_example' => $request->apr_example2,
                        ]);
                    }
                }

                return $this->getResponse(['message' => 'Lender updated!'], 200);
            } else {
                return $this->getResponse(['message' => 'Lender not found!'], 404);
            }
        } else {
            return $this->getResponse(['message' => 'You dont have access to do this operation!'], 403);
        }
    }

    /**
     * Return a JSON response.
     *
     * @param array $array
     * @param int $code
     * @return JsonResponse
     */
    public function getResponse(array $array, int $code): JsonResponse
    {
        return response()->json($array, $code);
    }
}
