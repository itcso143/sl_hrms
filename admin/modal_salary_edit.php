    <div class="modal fade" id="modal_salary_edit" tabindex="-1" aria-labelledby="addSalaryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 900px; width: 90%;">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="addSalaryModalLabel">
                    <i class="fa fa-calendar"></i>Salary
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="create_employee_salary.php">
                  <div class="modal-body">
                    <div class="card">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-1"></div>

                            <div class="col-md-5">
                              <label for="emp_id_edit_salary" class="form-label">EMP ID:</label>
                              <input readonly type="text" name="emp_id_edit_salary" id="emp_id_edit_salary" class="form-control">
                            </div>

                            <div class="col-md-5">
                              <label for="emp_salary_id_edit" class="form-label">Salary_id:</label>
                              <input readonly type="text" name="emp_salary_id_edit" id="emp_salary_id_edit" class="form-control">
                            </div>


                            <div class="col-md-1"></div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-1"></div>

                            <div class="col-md-5">
                              <label for="emp_fullname_edit_salary" class="form-label">Name:</label>
                              <input readonly type="text" name="emp_fullname_edit_salary" id="emp_fullname_edit_salary" class="form-control">
                            </div>

                           

                            <div class="col-md-1"></div>
                          </div>
                        </div>
                      </div>

                      <br>



                    </div>

                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="date_from">Date:</label>
                            <input type="date" name="date_create_salary" id="date_create_salary" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                        </div>
                        <br>
                   
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="get_schedule">Select Type of Address</label>
                            <select class="form-control select2" id="get_company" name="get_company">
                              <?php while ($get_company = $get_company_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_company == $get_company['company_name']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_company['company_name']; ?>">
                                  <?= $get_company['company_name']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="date_from">Date from:</label>
                            <input type="date" name="date_from" id="date_from" class="form-control">
                          </div>

                          <div class="col-lg-6">
                            <label for="date_to">Date to:</label>
                            <input type="date" name="date_to" id="date_to" class="form-control">
                          </div>
                        </div>
                        <br>

                        <!-- LATE DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_late_deduction_edit">Late:</label>
                            <input type="text" name="emp_late_deduction_edit" id="emp_late_deduction_edit" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_quantity_late">Quantity:</label>
                            <input type="text" name="emp_quantity_late" id="emp_quantity_late" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_rate_late">Rate:</label>
                            <input type="text" name="emp_rate_late" id="emp_rate_late" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_total_late">Total:</label>
                            <input type="text" name="emp_total_late" id="emp_total_late" class="form-control">
                          </div>

                        </div>
                        <br>
                        <!-- ABSENCES DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_absences_deduction">Absences:</label>
                            <input type="text" name="emp_absences_deduction" id="emp_absences_deduction" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_quantity_absences">Quantity:</label>
                            <input type="text" name="emp_quantity_absences" id="emp_quantity_absences" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_rate_absences">Rate:</label>
                            <input type="text" name="emp_rate_absences" id="emp_rate_absences" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_total_absences">Total:</label>
                            <input type="text" name="emp_total_absences" id="emp_total_absences" class="form-control">
                          </div>

                        </div>
                        <br>
                        <!-- HRMO DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_hrmo_deduction">HRMO:</label>
                            <input type="text" name="emp_hrmo_deduction" id="emp_hrmo_deduction" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_quantity">Quantity:</label>
                            <input type="text" name="emp_hrmo_quantity" id="emp_hrmo_quantity" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_rate">Rate:</label>
                            <input type="text" name="emp_hrmo_rate" id="emp_hrmo_rate" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_total">Total:</label>
                            <input type="text" name="emp_hrmo_total" id="emp_hrmo_total" class="form-control">
                          </div>

                        </div>
                        <br>

                        <div class="row">
                          <!-- <div class="col-lg-3">
                            <label for="emp_basic_salary">Basic Salary:</label>
                            <input type="text" name="emp_basic_salary" id="emp_basic_salary" class="form-control">
                          </div> -->

                          <div class="col-md-3">
                            <label for="get_schedule">Select Basic Salary</label>
                            <select class="form-control select2" id="emp_basic_salary" name="emp_basic_salary">
                              <?php while ($get_basic_salary = $get_basic_salary_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_basic_salary == $get_basic_salary['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_basic_salary['salary']; ?>">
                                  <?= $get_basic_salary['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>


                          <div class="col-md-3">
                            <label for="get_schedule">Select Quantity</label>
                            <select class="form-control select2" id="emp_quantity" name="emp_quantity">
                              <?php while ($get_quantity = $get_quantity_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_quantity == $get_quantity['quantity']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_quantity['quantity']; ?>">
                                  <?= $get_quantity['quantity']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="get_schedule">Select Rate</label>
                            <select class="form-control select2" id="emp_rate" name="emp_rate">
                              <?php while ($get_rate = $get_rate_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_rate == $get_rate['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_rate['salary']; ?>">
                                  <?= $get_rate['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>

                          <!-- <div class="col-lg-3">
                            <label for="emp_rate">Rate:</label>
                            <input type="text" name="emp_rate" id="emp_rate" class="form-control">
                          </div> -->
                          <!-- <div class="col-lg-3">
                            <label for="emp_total">Total:</label>
                            <input type="text" name="emp_total" id="emp_total" class="form-control">
                          </div> -->

                          <div class="col-md-3">
                            <label for="get_schedule">Select Total</label>
                            <select class="form-control select2" id="emp_total" name="emp_total">
                              <?php while ($get_total_salary = $get_emp_total_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_total_salary == $get_total_salary['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_total_salary['salary']; ?>">
                                  <?= $get_total_salary['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>

                        </div>
                        <br>
                        <div class="row">
                          <!-- <div class="col-lg-6">
                            <label for="emp_gross_pay">Current Gross Pay:</label>
                            <input type="text" name="emp_gross_pay" id="emp_gross_pay" class="form-control">
                          </div> -->

                          <div class="col-md-3">
                            <label for="get_schedule">Select Gross</label>
                            <select class="form-control select2" id="emp_gross_pay" name="emp_gross_pay">
                              <?php while ($get_gross = $get_emp_gross_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_gross == $get_gross['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_gross['salary']; ?>">
                                  <?= $get_gross['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>


                          <!-- <div class="col-lg-6">
                            <label for="emp_current_pay">Current Net Pay:</label>
                            <input type="text" name="emp_current_pay" id="netpay" class="form-control">
                          </div> -->

                          <div class="col-md-3">
                            <label for="get_schedule">Select Current Net Pay</label>
                            <select class="form-control select2" id="emp_current_pay" name="emp_current_pay">
                              <?php while ($get_netpay = $get_emp_netpay_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_netpay == $get_netpay['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_netpay['salary']; ?>">
                                  <?= $get_netpay['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" name="create_employee_salary" class="btn btn-primary" value="Update Salary">
                  </div>
                </form>

              </div>
            </div>
          </div>