<!-- Bulk Update Modal -->
<div class="modal fade" id="bulkUpdateModal" tabindex="-1" aria-labelledby="bulkUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkUpdateModalLabel">Set Bulk Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bulk-update-form">
                        <div class="form-group">
                            <label><input type="radio" name="update_type" value="set_to" checked> Set to</label>
                            <input type="text" name="set_to" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="update_type" value="by_price"> By Price</label>
                            <input type="text" name="by_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="update_type" value="by_percent"> By Percent</label>
                            <input type="text" name="by_percent" class="form-control">
                            <div>
                                <label><input type="radio" name="percent_type" value="increase" checked> Increase by</label>
                                <label><input type="radio" name="percent_type" value="decrease"> Decrease by</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price Type:</label>
                            <div>
                                <label><input type="checkbox" name="price_type[]" value="price" checked> POS Price</label>
                                <label><input type="checkbox" name="price_type[]" value="web_price"> Online Order</label>
                                <label><input type="checkbox" name="price_type[]" value="door_dash_price"> Door Dash Price</label>
                                <label><input type="checkbox" name="price_type[]" value="ubereats_price"> UberEats Price</label>
                                <label><input type="checkbox" name="price_type[]" value="grubhub_price"> Grubhub Price</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="bulk-update-submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Main Section End-->